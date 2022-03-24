<?php

namespace App\App\Traits\Activation;

use App\Domain\Activation\Status\ActivationStatus;
use App\Domain\Activation\User\UserActivation;
use App\Domain\Supplier\PurchasingOrder\Item\Breakdown\Breakdown;
use App\Domain\Supplier\PurchasingOrder\PurchasingOrder;
use App\Domain\System\Notification\Notification;
use Illuminate\Http\Request;

trait UserCanActivate
{
    public $status;

    public $committed_date;

    public $isPO; //Purchasing Orders if False  = Items

    public $lines = []; // to activate

    public $activation;

    public function activate(Request $request,$isPO = true)
    {
        $this->status = ActivationStatus::find($request->status_id);
        $this->committed_date = $request->committed_date;
        $this->isPO = $isPO;
        if ($this->checkCommittedDate()) {
            if($this->activation = UserActivation::create([
                'user_id' => Sentinel::getUser()->id,
                'activation_status_id'=> $this->status->id,
                'committed_date' => $this->committed_date,
                'commentary' => ($request->commentary != '') ? $request->commentary : null
            ])) {
                if($this->activateLines($request)) {
                    if ($this->handleNotification($request)) {
                        if ($this->handleFiles($request)) {
                            return response()->json(['success','Posiciones activadas correctamente']);
                        } else {
                            return response()->json(['error' => 'Error al adjuntar archivos'],401);
                        }
                    } else {
                        return response()->json(['error' => 'Error al crear las notificaciones'],401);
                    }
                } else {
                    return response()->json(['error' => 'Error al acoplar el status con las lineas.'],401);
                }
            } else {
                return response()->json(['error' => 'Error al crear status.'],401);
            }
        } else {
            return response()->json(['errors' => ['committed_date' => 'La fecha comprometida es obligatoria.']],422);
        }
    }

    protected function activateLines(Request $request)
    {
        return $this->activation->breakdowns()->attach($this->getLines($request));
    }

    protected function getLines(Request $request)
    {
        $ids = explode(',',$request->rows);
        if($this->isPO) {
            $pos = PurchasingOrder::with('items.breakdowns')->has('items.breakdowns')->find($ids);
            foreach ($pos as $po) {
                foreach($po->items as $item) {
                    foreach($item->breakdowns as $breakdown) {
                        array_push($this->lines,$breakdown->line_key);
                    }
                }
            }
        } else {
            $breakdowns = Breakdown::find($ids);
            foreach($breakdowns as $breakdown) {
                array_push($this->lines,$breakdown->line_key);
            }
        }
        return $this->lines;
    }

    protected function checkCommittedDate()
    {
        if($this->status->date_required == 1 && $this->committed_date == '') {
            return false;
        } else {
            if ($this->committed_date == '') {
                $this->committed_date = null;
            }
        }
        return true;
    }

    public function handleNotification(Request $request)
    {
        if ($this->committed_date != null) {
            if (isset($request->notification_date) && $request->notification_date != '') {
                $notification_date = $request->notification_date;
            } else {
                $notification_date = $this->committed_date;
            }
        } else {
            if (isset($request->notification_date) && $request->notification_date != '') {
                $notification_date = $request->notification_date;
            } else {
                $notification_date = false;
            }
        }

        if ($notification_date) {
            if($notification = Notification::create([
                'user_id' => Sentinel::getUser()->id,
                'title' => 'Recordatorio de Activación',
                'url' => $this->handleNotificationURL($request->rows),
                'message' => ($request->notification_commentary != '')? $request->notification_commentary:'No se ha agregado un mensaje',
                'notification_date' => $notification_date
            ])) {
                $notification->users()->attach(Sentinel::getUser()->id,['is_readed' => 0]);
            } else {
                return false;
            }
        }

        return true;
    }

    public function handleNotificationURL($rows)
    {
        $ids = explode(',',$rows);
        if($this->isPO) {
            $po = PurchasingOrder::with('supplier')->find($ids[0]);
            return '/supplier/'.$po->supplier->rut.'/orders';
        } else {
            $breakdown = Breakdown::with('item.purchasing_order')->find($ids[0]);
            return '/order/'.$breakdown->item->purchasing_order->order_number.'/items';
        }
    }

    public function handleFiles(Request $request)
    {
        for($i = 0; $i < count($request->file_id); $i++) {
            if(!$this->activation->files()->create([
                'file' => $request->file_name[$i],
                'file_type' => $request->file_type[$i]
            ])){
                return false;
            }
        }
        return true;
    }
}
