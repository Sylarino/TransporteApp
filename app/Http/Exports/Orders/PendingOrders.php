<?php

namespace App\Http\Exports\Orders;

use App\Domain\System\User\User;
use App\Exports\Orders\PendingOrdersExport;
use App\Http\Exports\Jobs\CreateExportReminder;
use App\Http\Exports\Jobs\NotifyExportLinkToUserInApp;
use App\Http\Exports\Jobs\NotifyExportLinkToUserInMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Maatwebsite\Excel\Excel;
use Sentinel;

class PendingOrders extends Controller
{
    public function __invoke()
    {
        $user = User::find(Sentinel::getUser()->id);
        $file_name = $user->id.'_'.rand(1,1000).'_Pedidos_Pendientes_'.Carbon::today()->toDateString().'.xlsx';

        CreateExportReminder::dispatch($file_name,$user);

        (new PendingOrdersExport)->queue($file_name,'exports')->chain([
            new NotifyExportLinkToUserInApp($file_name,$user),
            new NotifyExportLinkToUserInMail($file_name,$user)
        ]);

        return redirect()->back()->with('message', 'Se ha iniciado la creacion del archivo, debido a su peso se te notificara cuando este listo.');
    }
}
