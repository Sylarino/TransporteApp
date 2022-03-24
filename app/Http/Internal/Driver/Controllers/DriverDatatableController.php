<?php

namespace App\Http\Internal\Driver\Controllers;



use App\Domain\Internal\Driver\Driver;
use App\Http\System\DataTable\DataTableAbstract;

class DriverDatatableController extends DataTableAbstract
{
    public $entity = 'drivers';

    public function getRecord($record)
    {
        return [
            $record->rut,
            $record->user->first_name,
            $record->user->last_name,
            $record->user->email,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getRecords()
    {
        return Driver::with('user')->get();
    }
}
