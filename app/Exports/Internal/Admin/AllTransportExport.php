<?php

namespace App\Exports\Internal\Admin;

use App\Domain\Internal\Races\RaceLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllTransportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
       $query = RaceLog::with([
           'driver_shift.driver.user',
           'driver_shift.shift',
           'driver_shift.mobile.service',
           'to_destination',
           'from_destination',
       ])->get();
        return collect($query->map(function($record){
            return [
                $record->driver_shift['date'],
                $record->driver_shift->driver['rut'],
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
                $record->observations
            ];
        }));

    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Rut',
            'Conductor',
            'Movil',
            'Patente',
            'Jornada',
            'Turno',
            'Servicio',
            'Inicio',
            'Termino',
            'Desde',
            'Hasta',
            'Solicitante',
            'Pasajeros',
            'KM 1',
            'KM 2',
            'Observaciones'
        ];
    }
}
