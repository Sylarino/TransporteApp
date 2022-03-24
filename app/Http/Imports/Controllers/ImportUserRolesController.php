<?php

namespace App\Http\Imports\Controllers;


use App\Domain\System\Role\Role;
use App\Domain\System\User\User;
use App\Http\Imports\ImportAbstract;

class ImportUserRolesController extends ImportAbstract
{
    public function preloadData()
    {
        return [
            'users' => User::get(),
            'roles' => Role::get()
        ];
    }

    public function processRecord($record)
    {
        if ($user = $this->preloaded['users']->where('email',$record['email'])->first()) {
            if ($role = $this->preloaded['roles']->where('slug',$record['role'])->first()) {
                $user->roles()->attach($role->id);
                $this->markAsDoned($record['id']);
            } else {
                $this->markAsDoned($record['id'],'No existe Role');
            }
        } else {
            $this->markAsDoned($record['id'],'No existe usuario.');
        }
    }
}
