<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Transport\Destination\Destination;
use App\Http\Imports\ImportAbstract;

class ImportDestinationsController extends ImportAbstract
{
    public function processRecord($record)
    {
            Destination::firstOrCreate(
                ['destination' => $record['destination']],
                ['workplace_id' => 3]
            );

            $this->markAsDoned($record['id']);
    }
}
