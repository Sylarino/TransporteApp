<?php

namespace App\Domain\Transport\Destination;

use App\Domain\Client\Workplace;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'workplace_id',
        'destination'
    ];

    public function workplace()
    {
        return $this->belongsTo(Workplace::class);
    }
}
