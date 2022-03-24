<?php

namespace App\Domain\Internal\Driver;

use App\App\Traits\HasDateScopes;
use App\Domain\Internal\Mobile\Mobile;
use App\Domain\Internal\Races\RaceLog;
use App\Domain\Internal\Shift\Shift;
use Illuminate\Database\Eloquent\Model;

class DriverShift extends Model
{
    use HasDateScopes;

    public $timestamps = false;

    protected $fillable = [
        'driver_id',
        'shift_id',
        'mobile_id',
        'date'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id','id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class,'shift_id','id');
    }

    public function mobile()
    {
        return $this->belongsTo(Mobile::class ,'mobile_id','id');
    }

    public function races()
    {
        return $this->hasMany(RaceLog::class,'driver_shift_id','id');
    }
}
