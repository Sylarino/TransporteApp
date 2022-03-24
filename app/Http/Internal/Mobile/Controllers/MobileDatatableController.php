<?php

namespace App\Http\Internal\Mobile\Controllers;



use App\Domain\Internal\Mobile\Mobile;
use App\Http\System\DataTable\DataTableAbstract;

class MobileDatatableController extends DataTableAbstract
{
    public $entity = 'mobiles';

    public function getRecords()
    {
        return Mobile::with('service')->get();
    }

    public function getRecord($record)
    {
        return [
            $record->service->service,
            $record->mobile,
            $record->patent,
            $this->getOptionButtons($record->id)
        ];
    }
}
