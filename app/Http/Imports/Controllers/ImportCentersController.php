<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Center\Center;
use App\Http\Imports\ImportAbstract;

class ImportCentersController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (Center::findBySlug($record['slug'])) {
            $this->markAsDoned($record['id'],'Centro ya existe.');
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
        Center::insert($this->toInsert);
        $this->toInsert = [];
    }
}
