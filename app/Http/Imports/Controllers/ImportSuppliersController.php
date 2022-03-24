<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Supplier\Supplier;
use App\Http\Imports\ImportAbstract;

class ImportSuppliersController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (Supplier::where('rut',$record['rut'])->first()) {
            $this->markAsDoned($record['id'],'Proveedor ya existe.');
        } else {
            if(!array_search($record['rut'], array_column($this->toInsert, 'rut'))) {
                array_push($this->toInsert,[
                    'rut' => $record['rut'],
                    'name' => $record['name']
                ]);
            }
            $this->markAsDoned($record['id']);
        }
    }

    public function massInsert ()
    {
        Supplier::insert($this->toInsert);
        $this->toInsert = [];
    }
}
