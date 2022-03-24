<?php

namespace App\Http\Contact\Controllers;

use App\Domain\Contact\Contact;
use App\Http\Contact\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request)
    {
        if (Contact::create($request->all())) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.edit',compact('contact'));
    }

    public function update(ContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->update($request->all())) {
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }

    public function destroy($id)
    {
        if (Contact::has('supplier')->find($id)) {
            return response()->json(['error' => 'El Contacto esta asociado a un proveedor, eliminelo desde los contactos de proveedor.'],401);
        } else {
            if (Contact::destroy($id)) {
                return $this->getResponse('success.destroy');
            } else {
                return $this->getResponse('error.destroy');
            }
        }
    }
}
