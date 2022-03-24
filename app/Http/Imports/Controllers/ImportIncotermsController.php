<?php

namespace App\Http\Imports\Controllers;


use App\Domain\Client\Incoterm\Incoterm;
use App\Http\Imports\ImportAbstract;

class ImportIncotermsController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (Incoterm::findBySlug($record['slug'])) {
            $this->markAsDoned($record['id'],'Incoterm ya existe.');
        } else {
            array_push($this->toInsert,[
                'slug' => $record['slug'],
                'name' => $record['name']
            ]);
            $this->markAsDoned($record['id']);
        }
    }

    public function massInsert ()
    {
        Incoterm::insert($this->toInsert);
        $this->toInsert = [];
    }
}
