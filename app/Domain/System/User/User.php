<?php

namespace App\Domain\System\User;


use App\App\Traits\Permissions\Permissible;
use App\App\Traits\Roles\RoleableEntity;
use App\App\Traits\User\IncorporationRelationUsages;
use App\Domain\Internal\Driver\Driver;
use App\Domain\System\File\File;
use App\Domain\System\Import\ImportFile;
use App\Domain\System\Import\QueuedImport;
use App\Domain\System\Notification\Notification;
use App\Domain\User\Export\ExportReminder;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    use RoleableEntity,Permissible;

    public function destroyRelationships()
    {
        if(!optional($this->roles)->first() || $this->roles()->detach()) {
            return true;
        }
        return false;
    }

    public function getFullName()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function files()
    {
        return $this->hasMany(File::class,'user_id','id');
    }

    public function owned_notifications()
    {
    	return $this->hasMany(Notification::class,'user_id','id');
    }

	public function received_notifications()
	{
		return $this->belongsToMany(Notification::class,'user_notifications','user_id','notification_id')->withPivot('readed_at');
	}

	public function unread_notifications()
	{
		return $this->received_notifications()->whereNull('user_notifications.readed_at');
	}

	public function import_file()
    {
        return $this->hasMany(ImportFile::class,'user_id','id');
    }

    public function queued_imports()
    {
        return $this->hasMany(QueuedImport::class);
    }


    public function export_reminders()
    {
        return $this->hasMany(ExportReminder::class);
    }

    public function unread_export_reminders()
    {
        return $this->export_reminders()->where('export_reminders.is_created','=',1);
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class,'user_id','id');
    }
}
