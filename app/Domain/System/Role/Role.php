<?php

namespace App\Domain\System\Role;

use App\App\Traits\Permissions\Permissible;
use App\App\Traits\Sluggable;
use App\Domain\System\Import\Import;
use App\Domain\System\Menu\Menu;
use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
    use Sluggable,Permissible;

    protected $fillable = [
        'name','slug','permissions'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class,'role_menus','role_id','menu_id');
    }

    public function imports()
    {
        return $this->belongsToMany(Import::class,'role_imports','role_id','import_id');
    }

	public function destroyRelationships()
	{
		//users
		if(!optional($this->users)->first() || $this->users()->detach()) {
			if (!optional($this->menus)->first() || $this->menus()->detach()) {
				return true;
			}
		}
		return false;
	}
}
