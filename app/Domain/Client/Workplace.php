<?php

namespace App\Domain\Client;

use App\Domain\Internal\Mobile\Mobile;
use App\Domain\Transport\Destination\Destination;
use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'enterprise',
        'service'
    ];

    public function setEnterpriseAttribute($value)
    {
        $this->attributes['enterprise'] = ucfirst($value);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function mobiles()
    {
        return $this->hasMany(Mobile::class,'service_id','id');
    }
}
