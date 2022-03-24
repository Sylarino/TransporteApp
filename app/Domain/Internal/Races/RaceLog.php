<?php

namespace App\Domain\Internal\Races;

use App\Domain\Internal\Driver\DriverShift;
use App\Domain\Transport\Destination\Destination;
use Illuminate\Database\Eloquent\Model;

class RaceLog extends Model
{
    protected $fillable = [
        'driver_shift_id',
        'patent',
        'start_time',
        'end_time',
        'from_id',
        'to_id',
        'from_text',
        'to_text',
        'passengers_count',
        'passengers',
        'start_mileage',
        'end_mileage',
        'observations',
        'valid_day',
        'next_day'
    ];

    public function driver_shift()
    {
        return $this->belongsTo(DriverShift::class,'driver_shift_id','id');
    }

    public function to_destination()
    {
        return $this->belongsTo(Destination::class,'to_id','id');
    }

    public function from_destination()
    {
        return $this->belongsTo(Destination::class,'from_id','id');
    }
}
