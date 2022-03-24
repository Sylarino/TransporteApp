<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\BuyingGroup\BuyingGroup;
use App\Http\Imports\ImportAbstract;

class ImportBuyingGroupsController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (BuyingGroup::findBySlug($record['slug'])) {
            $this->markAsDoned($record['id'],'Grupo de Compra ya existe.');
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
        BuyingGroup::insert($this->toInsert);
        $this->toInsert = [];
    }
}
