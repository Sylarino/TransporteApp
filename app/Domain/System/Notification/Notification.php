<?php

namespace App\Domain\System\Notification;

use App\App\Traits\HasDateScopes;
use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Notification extends Model
{
	use HasDateScopes;

    protected $fillable = [
    	'user_id','title','message','url','notification_date'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id','id');
    }

    public function receivers()
    {
    	return $this->belongsToMany(User::class,'user_notifications','notification_id','user_id')->withPivot('readed_at');
    }

}
