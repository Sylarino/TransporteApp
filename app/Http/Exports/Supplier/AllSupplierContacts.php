<?php

namespace App\Http\Exports\Supplier;

use App\Exports\Supplier\AllSupplierContactsExport;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Excel;

class AllSupplierContacts extends Controller
{
    public function __invoke()
    {
        return Excel::download(new AllSupplierContactsExport(),'contactos_proveedores.xlsx');
    }
}
