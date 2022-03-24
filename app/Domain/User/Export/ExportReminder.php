<?php

namespace App\Domain\User\Export;

use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class ExportReminder extends Model
{
    protected $fillable = [
        'user_id',
        'file',
        'is_readed',
        'is_created'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
