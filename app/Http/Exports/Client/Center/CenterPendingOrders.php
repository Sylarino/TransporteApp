<?php

namespace App\Http\Exports\Client\Center;

use App\Domain\Client\Center\Center;
use App\Exports\Client\Center\CenterPendingOrdersExport;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Excel;

class CenterPendingOrders extends Controller
{
    public function __invoke($id)
    {
        $center = Center::findOrFail($id);
        return Excel::download(new CenterPendingOrdersExport($center),'Centro_'.$center->slug.'_Ordenes_Pendientes.xlsx');
    }
}
