<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Contract\ContractCategory;
use App\Http\Imports\ImportAbstract;

class ImportContractCategoriesController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (ContractCategory::findBySlug($this->toSlug($record['name']))) {
            $this->markAsDoned($record['id'],'Categoria ya existe.');
        } else {
            if(ContractCategory::create([
                'slug' => $this->toSlug($record['name']),
                'name' => $record['name']
            ])) {
                $this->markAsDoned($record['id']);
            } else {
                $this->markAsDoned($record['id'],'Error al crear categoria: '.$record['name'].' slug:'. $this->toSlug($record['name']));
            }

        }
    }

    public function toSlug($name)
    {
        return str_slug($name,'-');
    }
}
