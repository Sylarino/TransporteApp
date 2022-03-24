<?php

namespace App\Domain\System\Notification;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = ['notification_id','user_id','readed_at'];
}
