<?php

namespace App\Http\Internal\Driver\Race\Controllers;


use App\Domain\Internal\Races\RaceLog;
use App\Http\System\DataTable\DataTableAbstract;

class DriverRaceDatatableController extends DataTableAbstract
{
    public function getRecord($record)
    {
        return [
            $record->driver_shift->date,
            $record->driver_shift->driver->rut,
            $record->driver_shift->driver->user->getFullName(),
            $record->driver_shift->mobile->mobile,
            $record->patent,
            $record->driver_shift->shift->name,
            $record->driver_shift->shift->start_time.'/'.$record->driver_shift->shift->end_time,
            $record->driver_shift->mobile->service->service,
            $record->start_time,
            $record->end_time,
            (optional($record->from_destination)->name)?optional($record->from_destination)->name:$record->from_text,
            (optional($record->to_destination)->name)?optional($record->to_destination)->name:$record->to_text,
            $record->passengers,
            $record->passengers_count,
            $record->start_mileage,
            $record->end_mileage,
            $record->observations,
        ];
    }

    public function getRecords()
    {
        return RaceLog::with([
            'driver_shift.driver.user',
            'driver_shift.shift',
            'driver_shift.mobile.service',
            'to_destination',
            'from_destination',
        ])->get();
    }
}
