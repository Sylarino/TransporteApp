<?php

namespace App\Domain\System\Import;

use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class QueuedImport extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id','name','imports'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
