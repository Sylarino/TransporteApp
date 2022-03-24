<?php

namespace App\Http\Exports\Supplier;

use App\Exports\Supplier\SupplierContactsWithPendingOrdersExport;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Excel;

class SupplierContactsWithPendingOrders extends Controller
{
    public function __invoke()
    {
        return Excel::download(new SupplierContactsWithPendingOrdersExport(),'contactos_proveedores_c_ped_pen.xlsx');
    }
}
