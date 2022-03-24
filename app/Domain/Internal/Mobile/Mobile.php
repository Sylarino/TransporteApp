<?php

namespace App\Domain\Internal\Mobile;

use App\Domain\Client\Workplace;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'mobile',
        'service_id',
        'patent'
    ];

    public function service()
    {
        return $this->belongsTo(Workplace::class,'service_id','id');
    }
}
