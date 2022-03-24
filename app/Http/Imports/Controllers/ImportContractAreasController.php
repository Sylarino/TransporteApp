<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Contract\ContractArea;
use App\Http\Imports\ImportAbstract;

class ImportContractAreasController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (ContractArea::findBySlug($record['slug'])) {
            $this->markAsDoned($record['id'],'area ya existe.');
        } else {
            array_push($this->toInsert,[
                'slug' => $this->toSlug($record['name']),
                'name' => $record['name']
            ]);
            $this->markAsDoned($record['id']);
        }
    }

    public function massInsert ()
    {
        ContractArea::insert($this->toInsert);
        $this->toInsert = [];
    }

    public function toSlug($name)
    {
        return strtolower(str_slug($name,'-'));
    }
}
