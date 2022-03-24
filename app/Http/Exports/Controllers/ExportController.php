<?php

namespace App\Http\Exports\Controllers;

use App\Domain\User\Export\ExportReminder;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Storage;

class ExportController extends Controller
{
    public $cols =  ['Nombre','Descripcion','Exportar'];

    public function index()
    {
        $cols = $this->cols;
        $rows = $this->getRowsArray();
        return view('exports.index', compact('cols','rows'));
    }

    public function getRowsArray()
    {
        return  [
            [
                'Pedidos Pendientes',
                'Descarga Masiva de Pedidos Pendientes',
                $this->getExportButton(route('export.pendingOrders'))
            ],
            [
                'Contactos Proveedor (todos)',
                'Incluye los contactos de todos los proveedores, inclusive aquellos que no tienen ordenes de compra pendiente',
                $this->getExportButton(route('export.allSupplierContacts'))
            ],
            [
                'Contactos Proveedor(Con Pendientes)',
                'Incluye los contactos de proveedor que poseen ordenes de compra pendientes en sistema.',
                $this->getExportButton(route('export.supplierContactsWithPendingOrders'))
            ]
        ];
    }

    public function getExportButton($route)
    {
        return makeLink($route,'Descargar','fa-file-excel','btn-success','btn-sm');

    }

    public function downloadQueued($file_name)
    {
        $reminder = ExportReminder::where('file',$file_name)->firstOrFail();
        $reminder->delete();
        return response()->download(storage_path('app/public/exports/'.$file_name));
    }
}
