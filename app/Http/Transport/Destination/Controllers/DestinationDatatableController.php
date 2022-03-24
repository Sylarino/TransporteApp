<?php

namespace App\Http\Transport\Destination\Controllers;


use App\Domain\Transport\Destination\Destination;
use App\Http\System\DataTable\DataTableAbstract;

class DestinationDatatableController extends DataTableAbstract
{
    public $entity = 'destinations';

    public function getRecord($record)
    {
        return [
            $record->workplace->service,
            $record->destination,$this->getOptionButtons($record->id)
        ];
    }

    public function getRecords()
    {
        return Destination::with('workplace')->get();
    }
}
