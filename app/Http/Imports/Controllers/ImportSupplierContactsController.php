<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Client\Center\Center;
use App\Domain\Contact\Contact;
use App\Domain\Supplier\Supplier;
use App\Http\Imports\ImportAbstract;

class ImportSupplierContactsController extends ImportAbstract
{
    public function preloadData()
    {
        return[
            'contacts' => Contact::get(),
            'suppliers' => Supplier::get(),
            'centers' => Center::get()
        ];
    }

    public function processRecord($record)
    {
        if ($contact = $this->preloaded['contacts']->where('email',$record['email'])->first()) {
            if ($supplier = $this->preloaded['suppliers']->where('rut',$record['rut'])->first()) {
                if(!$center = $this->findInPreloaded('centers','slug',$record['center'])){
                    $center = $this->findInPreloaded('centers','slug','CORP');
                }
                $contact->supplier()->attach($supplier->id,['center_id' => $center->id]);
                $this->markAsDoned($record['id']);
            } else {
                $this->markAsDoned($record['id'],'No existe proveedor');
            }
        } else {
            $this->markAsDoned($record['id'],'No existe Contacto');
        }
    }
}
