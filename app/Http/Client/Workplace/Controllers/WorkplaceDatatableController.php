<?php

namespace App\Http\Client\Workplace\Controllers;



use App\Domain\Client\Workplace;
use App\Http\System\DataTable\DataTableAbstract;

class WorkplaceDatatableController extends DataTableAbstract
{
    public $entity = 'workplaces';

    public function getRecord($record)
    {
        return [
            $record->enterprise,
            $record->service,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getRecords()
    {
        return Workplace::get();
    }
}
