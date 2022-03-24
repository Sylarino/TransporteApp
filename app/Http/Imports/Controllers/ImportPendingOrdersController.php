<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\BuyingGroup\BuyingGroup;
use App\Domain\Client\Center\Center;
use App\Domain\Client\Center\Warehouse\Warehouse;
use App\Domain\Client\Incoterm\Incoterm;
use App\Domain\Supplier\PurchasingOrder\Item\Breakdown\Breakdown;
use App\Domain\Supplier\PurchasingOrder\Item\Item;
use App\Domain\Supplier\PurchasingOrder\PurchasingOrder;
use App\Domain\Supplier\Supplier;
use App\Domain\System\Import\ImportTemp;
use App\Http\Imports\ImportAbstract;
use App\Http\Supplier\Orders\Events\OrderCreated;
use App\Http\Supplier\Orders\Items\Events\BreakdownChanged;
use App\Http\Supplier\Orders\Items\Events\BreakdownCreated;


class ImportPendingOrdersController extends ImportAbstract
{
    public function preloadData()
    {
        return [
            'suppliers' => Supplier::get(),
            'warehouses' => Warehouse::get(),
            'buyingGroups' => BuyingGroup::get(),
            'centers' => Center::get(),
            'incoterms' => Incoterm::get()
        ];
    }

    public function beforeLoad($id)
    {
        $package = $this->getPackage($id,-1);
        $temps = array_filter($package, function($row) {
            return (
                ($row['release_indicator'] == 'Pedido Bloqueado') ||
                ($row['buying_unit_slug'] != 'P001') ||
                (substr($row['order_number'],0,2) == '47') ||
                ((!stristr($row['supplier_rut'],'-')) && !$this->supplierInContract($row['supplier_rut']))
            );
        });
        ImportTemp::destroy(array_values(array_column($temps,'id')));
        return true;
    }

    public function  processRecord($record)
    {
        $lineKey = implode('-', [
            $record['order_number'],
            $record['position'],
            $record['breakdown_number']
        ]);

        $line = Breakdown::with('item')->where('line_key',$lineKey)->first();

        $requested = $this->separateQuantity($record['requested']);
        $delivered = $this->separateQuantity($record['delivered']);
        $pending = $this->separateQuantity($record['pending']);
        $unit = explode(' ',$record['requested'])[1];

        if ($line) {
            if (getFormattedDate($record['delivery_date']) != $line->delivery_date) {
                event(new BreakdownChanged($line,[
                    'delivery_date' => getFormattedDate($record['delivery_date']),
                    'requested_quantity' => $requested,
                    'delivered_quantity' => $delivered,
                    'pending_quantity' => $pending,
                ]));
            }
            $this->markAsDoned($record['id']);
        } else {
            if (!$supplier = $this->findInPreloaded('suppliers','rut',$record['supplier_rut'])) {
                $supplier = Supplier::create([
                    'rut' => $record['supplier_rut'],
                    'name' => $record['supplier_name']
                ]);
                $this->preloaded['suppliers'] = Supplier::get();
            }
            $error  = 0;
            if (!$po = PurchasingOrder::where('order_number',$record['order_number'])->first()) {
                if ($buyingGroup = $this->findInPreloaded('buyingGroups','slug',$record['buying_group_slug'])) {
                        if($incoterm = $this->findInPreloaded('incoterms','slug',$record['incoterm_slug'])) {
                            if($center = $this->findInPreloaded('centers','slug',$record['center'])) {
                                $po = PurchasingOrder::create([
                                    'order_number' => $record['order_number'],
                                    'supplier_id' => $supplier->id,
                                    'buying_group_id' => $buyingGroup->id,
                                    'center_id' => $center->id,
                                    'incoterm_id' => $incoterm->id,
                                    'buying_organization' => 'P001',
                                    'user_id' => null,
                                    'contract_number' => ($record['contract_number'] == '#')?null:$record['contract_number']
                                ]);
                                event(new OrderCreated($po));
                            } else {
                                $error  = 1;
                                $this->markAsDoned($record['id'],'No existe el centro: '.$record['center']);
                            }
                        } else {
                            $error  = 1;
                            $this->markAsDoned($record['id'],'No existe incoterms: '.$record['incoterm_slug']);
                        }
                } else {
                    $error  = 1;
                    $this->markAsDoned($record['id'],'No existe Grupo de compra: '.$record['buying_group_slug']);
                }
            }

            if ($error == 0 && $po) {
                if (!$item = Item::where([
                    'purchasing_order_id' => $po->id,
                    'position' => $record['position']
                ])->first()) {
                    if (is_numeric($record['material'])) {
                        if($warehouse = $this->findInPreloaded('warehouses','slug',$record['warehouse_slug'])) {
                            if (!$item = $po->items()->create([
                                'warehouse_id' => $warehouse->id,
                                'position' => $record['position'],
                                'material' => $record['material'],
                                'short_text' => $record['short_text'],
                                'is_critical' => 0
                            ])) {
                                $error = 1;
                                $this->markAsDoned($record['id'],'No se pudo crear la posicion');
                            }
                        } else {
                           $error = 1;
                           $this->markAsDoned($record['id'],'No existe almacen: '.$record['warehouse_slug']);
                        }
                    } else {
                        $error = 1;
                        $this->markAsDoned($record['id'],'El material no esta compuesto de numeros.');
                    }
                }
                if ($error == 0 && $item) {
                    if(!$breakdown = $item->breakdowns()->create([
                        'breakdown_number' => $record['breakdown_number'],
                        'status' => $record['delivery_indicator'],
                        'erase_indicator' => $record['erase_indicator'],
                        'delivery_date' => getFormattedDate($record['delivery_date']),
                        'creation_date' => getFormattedDate($record['creation_date']),
                        'requested_quantity' => $requested,
                        'delivered_quantity' => $delivered,
                        'pending_quantity' => $pending,
                        'unit' => $unit,
                        'line_key' => $lineKey,
                        'is_pending' => 1
                    ])) {
                        $this->markAsDoned($record['id'],'No se pudo crear el Reparto.');
                    } else {
                        event(new BreakdownCreated($breakdown));
                        $this->markAsDoned($record['id']);
                    }
                }
            } else {
                $this->markAsDoned($record['id'],'Error al crear OC.');
            }
        }
    }

    public function separateQuantity($string)
    {
        return str_replace('.','',explode(" ",$string)[0]);
    }

    public function supplierInContract($rut)
    {
        if(Supplier::whereRut($rut)->has('contracts')->first()) {
            return true;
        }
        return false;
    }
}
