<?php

namespace App\Http\Internal\Shift\Controllers;


use App\Domain\Internal\Shift\Shift;
use App\Http\System\DataTable\DataTableAbstract;

class ShiftDatatableController extends DataTableAbstract
{
    public $entity = 'shifts';

    public function getRecords()
    {
        return Shift::get();
    }

    public function getRecord($record)
    {
        return [
            $record->start_time,
            $record->end_time,
            $record->name,
            $this->getOptionButtons($record->id)
        ];
    }
}
