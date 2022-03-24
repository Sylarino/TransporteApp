<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\BuyingGroup\BuyingGroup;
use App\Domain\Client\Contract\ContractArea;
use App\Domain\Client\Contract\ContractCategory;
use App\Domain\Client\Incoterm\Incoterm;
use App\Domain\Supplier\Contract\Contract;
use App\Domain\Supplier\Supplier;
use App\Domain\System\User\User;
use App\Http\Client\Contract\Events\ChangedManagerUser;
use App\Http\Imports\ImportAbstract;

class ImportContractsController extends ImportAbstract
{

    public $divisionalManager = 'Gestionador División';


    public function preloadData()
    {
        return [
            'categories' => ContractCategory::get(),
            'areas' => ContractArea::get(),
            'suppliers' => Supplier::get(),
            'incoterms' => Incoterm::get(),
            'buying_groups' => BuyingGroup::get()
        ];
    }

    public function processRecord($record)
    {
        $error = 0;
        $msg = '';
        if(!$supplier = $this->findInPreloaded('suppliers','rut',$record['supplier_rut'])) {
            $supplier = Supplier::create([
                'rut' => $record['supplier_rut'],
                'name' => $record['supplier_name']
            ]);
            $this->preloaded['suppliers'] = Supplier::get();
        }

        if(!$incoterm = $this->findInPreloaded('incoterms','slug',$record['incoterm'])) {
            $incoterm = null;
        } else {
            $incoterm = $incoterm->id;
        }

        if(!$buying_group = $this->findInPreloaded('buying_groups','slug',$record['buying_group'])) {
            $error = 1;
            $msg = 'Grupo de compra no existe.';
        }

        if (!$category = $this->findInPreloaded('categories','slug',str_slug($record['category']))) {
            $error = 1;
            $msg = 'No se ha creado la categoria.';
        }

        if(!$area = $this->findInPreloaded('areas','slug',str_slug($record['area']))) {
            $error = 1;
            $msg = 'No se ha creado el area.';
        }

        $user = $this->resolveUser($record['user']);
        $contract = Contract::where('contract_number',$record['contract_number'])->first();
        if($error == 0) {
            if($contract) {
                if ($contract->user_id != optional($user)->id) {
                    event(new ChangedManagerUser($contract,$user));
                }

                $contract->update([
                    'contract_category_id' => $category->id,
                    'contract_area_id' => $area->id,
                    'supplier_id' => $supplier->id,
                    'incoterm_id' => $incoterm,
                    'buying_group_id' => $buying_group->id,
                    'business_manager' => $record['business_manager'],
                    'user_id' => ($user)?$user->id:null,
                    'internal_id' => $record['internal_id'],
                    'business_title' => $record['business_title'],
                    'start_date' => getFormattedDate($record['start_date']),
                    'end_date' => getFormattedDate($record['end_date']),
                    'new_end_date' => ($record['new_end_date'] != '')?getFormattedDate($record['new_end_date']):null,
                    'related' => $record['related'],
                    'in_variant' => $record['in_variant'],
                    'consignment' => ($record['consignment'] == 'No')?0:1,
                    'observations' => $record['observations'] ,
                    'release_indicator' => $record['release_indicator'],
                    'positions' => $record['positions'],
                    'currency' => $record['currency'],
                    'fulfillment' => $this->resolvePercentage($record['fulfillment']),
                    'buying_organization' => $record['buying_organization'],
                ]);
            } else {
                $contract =  Contract::create([
                    'contract_number' => $record['contract_number'],
                    'contract_category_id' => $category->id,
                    'contract_area_id' => $area->id,
                    'supplier_id' => $supplier->id,
                    'incoterm_id' => $incoterm,
                    'buying_group_id' => $buying_group->id,
                    'business_manager' => $record['business_manager'],
                    'user_id' => ($user)?$user->id:null,
                    'internal_id' => $record['internal_id'],
                    'business_title' => $record['business_title'],
                    'start_date' => getFormattedDate($record['start_date']),
                    'end_date' => getFormattedDate($record['end_date']),
                    'new_end_date' => ($record['new_end_date'] != '')?getFormattedDate($record['new_end_date']):null,
                    'related' => $record['related'],
                    'in_variant' => $record['in_variant'],
                    'consignment' => ($record['consignment'] == 'No')?0:1,
                    'observations' => $record['observations'] ,
                    'release_indicator' => $record['release_indicator'],
                    'positions' => $record['positions'],
                    'currency' => $record['currency'],
                    'fulfillment' => $this->resolvePercentage($record['fulfillment']),
                    'buying_organization' => $record['buying_organization'],
                    'is_active' => 1
                ]);
                event(new ChangedManagerUser($contract,$user));
            }
            $this->markAsDoned($record['id']);
        } else {
            $this->markAsDoned($record['id'],$msg);
        }
    }

    public function resolveUser($userName)
    {
        if($userName == $this->divisionalManager) {
            return null;
        } else {
            $u = explode(' ',$userName);
            return User::where('first_name', $u[0])->where('last_name' , $u[1])->first();
        }
    }

    public function resolvePercentage($string)
    {
        if($string == 'Sin Medición' || $string == '') {
            return null;
        } else {
            return str_replace('%','',str_replace(',','.',$string));
        }
    }
}
