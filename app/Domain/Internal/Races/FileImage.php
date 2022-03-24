<?php

namespace App\Domain\Internal\FileImage;

use App\Domain\Internal\Races\RaceLog;
use Illuminate\Database\Eloquent\Model;

class FileImage extends Model
{
    protected $fillable = [
        'race_logs_id',
        'file_path',
    ];

    public function driver_shift()
    {
        return $this->belongsTo(RaceLog::class,'race_logs_id','id');
    }

}
