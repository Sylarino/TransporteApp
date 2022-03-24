<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Center\Center;
use App\Domain\Client\Center\Warehouse\Warehouse;
use App\Http\Imports\ImportAbstract;

class ImportWarehousesController extends ImportAbstract
{
    public function preloadData()
    {
        return [ 'centers' => Center::get()];
    }

    public function processRecord ($record)
    {
        if (Warehouse::findBySlug($record['slug'])) {
            $this->markAsDoned($record['id'],'Almacen ya existe.');
        } else {
            array_push($this->toInsert,[
                'slug' => $record['slug'],
                'name' => $record['name'],

                'center_id' => Center::where('slug',$record['center'])->first()->id
            ]);
            $this->markAsDoned($record['id']);
        }
    }

    public function massInsert ()
    {
        Warehouse::insert($this->toInsert);
        $this->toInsert = [];
    }
}
