<?php

namespace App\Http\Contact\Controllers;



use App\Domain\Contact\Contact;
use App\Http\System\DataTable\DataTableAbstract;

class ContactDatatableController extends DataTableAbstract
{
    public $entity = 'contacts';

    public function getRecord($record)
    {
        return [
            $record->first_name,
            $record->last_name,
            $record->phones,
            $record->email,
            $record->address,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getRecords()
    {
        return Contact::get();
    }
}
