<?php

namespace App\Http\Imports\Controllers;

use App\Domain\Contract\Incorporation\Incorporation;
use App\Domain\Contract\Incorporation\IncorporationRejectionReason;
use App\Domain\Contract\Incorporation\IncorporationStatus;
use App\Http\Imports\ImportAbstract;

class ImportCompletedIncorporationsController extends ImportAbstract
{

    public function processRecord($record)
    {
        $incorporation = Incorporation::where('order_number',$record['order_number'])
            ->where('position',$record['position'])->first();
        if($record['completed_at'] != '') {
            $incorporation->completed_at = getFormattedDate($record['completed_at']);
            $incorporation->rejected_at = null;
            $incorporation->is_pending = null;
            $incorporation->save();
        } else {
            if($record['rejected_at'] != ''){
                if($record['reason'] == 'rechazo-por-proveedor') {
                    $status = IncorporationStatus::findBySlug('rechazo-proveedor');
                    $reason = IncorporationRejectionReason::findBySlug('rechazo-por-proveedor');
                } else {
                    $status = IncorporationStatus::findBySlug('rechazo');
                    $reason = IncorporationRejectionReason::findBySlug($record['reason']);
                }

                $incorporation->completed_at = null;
                $incorporation->rejected_at = getFormattedDate($record['rejected_at']);
                $incorporation->is_pending = null;
                $incorporation->incorporation_status_id = $status->id;
                $incorporation->incorporation_rejection_reason_id = $reason->id;
                $incorporation->save();
            }
        }
        $this->markAsDoned($record['id']);
    }
}
