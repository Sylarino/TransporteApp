<?php

namespace App\Domain\System\Role;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    public $timestamps = false;

    protected $fillable = ['menu_id','role_id'];
}
