<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Center\Center;
use App\Domain\Client\Incoterm\Incoterm;
use App\Domain\Contract\Incorporation\Incorporation;
use App\Domain\Supplier\Supplier;
use App\Domain\System\User\User;
use App\Http\Contract\Incorporation\Events\IncorporationCreated;
use App\Http\Imports\ImportAbstract;
use Carbon\Carbon;

class ImportIncorporationsController extends ImportAbstract
{
    public function preloadData()
    {
        return [
            'suppliers' => Supplier::get(),
            'centers' => Center::get(),
            'incoterms' => Incoterm::get(),
            'users' => User::get()
        ];
    }

    public function processRecord($record)
    {
        if (!$supplier = $this->findInPreloaded('suppliers','rut',$record['supplier_rut'])) {
            $supplier = Supplier::create([
                'rut' => $record['supplier_rut'],
                'name' => $record['supplier_name']
            ]);

            $this->preloaded['suppliers'] = Supplier::get();
        }
        $center = $this->findInPreloaded('centers','slug',$record['center']);
        $incoterm = $this->findInPreloaded('incoterms','slug',$record['incoterm']);

        if($incorporation = Incorporation::updateOrCreate([
                'order_number' => $record['order_number'],
                'position' => $record['position']
        ], [
                'supplier_id' => $supplier->id,
                'center_id' => $center->id,
                'incoterm_id' => $incoterm->id,
                'material' => $record['material'],
                'short_text' => $record['short_text'],
                'article_group' => $record['article_group'],
                'last_purchase' => getFormattedDate($record['last_purchase']),
                'ump' => $record['ump'],
                'last_price' => ($record['last_price'])?str_replace('.','',$record['last_price']):null,
                'last_currency' => $record['last_currency'],
                'possible_contract' => $record['possible_contract'],
                'contract_currency' => $record['contract_currency'],
                'price' => ($record['price'] != '')?str_replace('.','',$record['price']):null,
                'delivery_term' => ($record['delivery_term'] != '' )?(int) $record['delivery_term']:null,
                'suggested_contract' => $record['suggested_contract'],
                'supplier_observations' => $record['supplier_observations'],
                'solped' => ($record['solped'] != '')?$record['solped']:null,
                'buyer' => $record['buyer']
        ])) {
             event(new IncorporationCreated($incorporation,$record['user']));
             $this->resolveIsPending($record,$incorporation);
            $this->markAsDoned($record['id']);
        } else {
            $this->markAsDoned($record['id'],'No se pudo crear la incorporacion');
        }

    }

    public function resolveIsPending($record,$incorporation)
    {
        if($record['price'] != '' || $record['delivery_term'] != '' || $record['supplier_observations'] != '') {
            if($incorporation->completed_at == null && $incorporation->rejected_at == null && $incorporation->is_pending == null) {
                $incorporation->is_pending = 1;
                $incorporation->received_at = Carbon::today()->toDateString();
                $incorporation->save();
            } else {
                $incorporation->is_pending = 0;
                $incorporation->save();
            }
        }
    }
}
