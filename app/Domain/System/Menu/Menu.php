<?php

namespace App\Domain\System\Menu;

use App\App\Traits\Roles\RoleableEntity;
use App\App\Traits\Sluggable;
use App\Domain\System\Menu\Traits\NestableMenu;
use App\Domain\System\Role\Role;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Sluggable,RoleableEntity,NestableMenu;

    protected $fillable = [
        'route','name','slug','icon','parent_id','position','type','created_at','updated_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_menus','menu_id','role_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id','id');
    }

    public static function getMenu($type = 'main-menu')
    {
        return static::where('type',$type)->with('roles')->orderBy('position')->get();
    }

    public function makeMenu()
    {
        return $this->generateMenu();
    }
}
