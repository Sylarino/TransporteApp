<?php

namespace App\Http\Imports\Controllers;


use App\Domain\Contact\Contact;
use App\Http\Imports\ImportAbstract;

class ImportContactsController extends ImportAbstract
{
    public function processRecord ($record)
    {
        if (Contact::where('email',$record['email'])->first()) {
            $this->markAsDoned($record['id'],'Contacto ya existe.');
        } else {
            array_push($this->toInsert,[
                'email' => $record['email'],
                'first_name' => $record['first_name'],
                'last_name' => $record['last_name'],
                'phones' => $record['phones'],
                'address' => ($record['address'] != '')?$record['address']:null
            ]);
            $this->markAsDoned($record['id']);
        }
    }

    public function massInsert ()
    {
        Contact::insert($this->toInsert);
        $this->toInsert = [];
    }
}
