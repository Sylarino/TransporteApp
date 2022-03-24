<?php

namespace App\Http\System\User\Controllers;

use App\Domain\System\User\User;
use App\Http\System\DataTable\DataTableAbstract;
use Sentinel;

class UserDatatableController extends DataTableAbstract
{
	public function getRecords()
	{
		return User::get();
	}

	public function getRecord($record)
	{
		return [
			$record->first_name,
			$record->last_name,
			$record->email,
			$this->getOptionButtons($record->id)
		];
	}

     function getOptionButtons($id)
    {
        $user = Sentinel::getUser();
        $buttons = array();
        if ($user->hasAnyAccess(['users.update','users.delete','users.roles','users.password-reset','users.permissions'])) {
            $buttons = [
                makeEditButton($id,'',true,true),
                makeDeleteButton("Realmente desea eliminar al Usuario?",$id,"'reload'",'',true),
            ];
            if ($user->hasAccess('users.roles')) {
                array_push(
                    $buttons,
                    makeRemoteLink('/userRoles/'.$id,'Roles','fa-key','','',true)
                );
            }

            if($user->hasAccess('users.reset-password')) {
                array_push(
                    $buttons,
                    makeRemoteLink('/userPasswordReset/'.$id,'Reset Password','fa-user-secret','','',true)
                );
            }

            if($user->hasAccess('users.permissions')) {
                array_push(
                    $buttons,
                    makeRemoteLink('/userPermissions/'.$id,'Permisos','fa-th-list','','',true)
                );
            }

            return makeGroupedLinks($buttons);
        } else {
            return '-';
        }
    }
}
