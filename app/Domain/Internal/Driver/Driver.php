<?php

namespace App\Domain\Internal\Driver;

use App\Domain\System\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'rut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shifts()
    {
        return $this->hasMany(DriverShift::class,'driver_id','id');
    }

    public function hasShiftCreated()
    {
        $shift = $this->shifts()->where('date',Carbon::now()->toDateString())->first();

        if(!$shift) {

            $shift = $this->shifts()->with('shift')->where('date',Carbon::yesterday()->toDateString())->first();
            if(!$shift) {
                return false;
            } else {
                $shift_date = Carbon::createFromFormat('Y-m-d',$shift->date);
                $start_shift = $shift_date->toDateString().' '.$shift->shift->start_time.':00';
                if(explode(':',$shift->shift->start_time)[0] > 12 && explode(':',$shift->shift->end_time)[0] < 12) {
                    $end_shift = $shift_date->addDay()->toDateString().' '.$shift->shift->end_time.':00';
                } else {
                    $end_shift = $shift_date->toDateString().' '.$shift->shift->end_time.':00';
                }
                $now = Carbon::now()->toDateTimeString();
                $inside = (Carbon::parse($end_shift)->addHours(3) >= Carbon::parse($now))?true:false;
                if($inside) { return $shift;}
                return $inside;
            }

        }

        return $shift;
    }
}
