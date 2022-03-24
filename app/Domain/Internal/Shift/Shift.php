<?php

namespace App\Domain\Internal\Shift;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start_time', 'end_time','name'
    ];
}
