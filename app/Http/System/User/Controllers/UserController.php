<?php

namespace App\Http\System\User\Controllers;

use App\Domain\System\User\User;
use App\Http\System\User\Events\AdminRegistersUser;
use App\Http\System\User\Requests\StoreUserRequest;
use App\Http\System\User\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;
use Sentinel;

class UserController extends Controller
{

    public function index()
    {
        return view('system.user.index');
    }

    public function create()
    {
        return view('system.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        if ($user = Sentinel::registerAndActivate(array_merge($request->all(),[
            'password' => explode('@',$request->email)[0]
        ]))) {
            event(new AdminRegistersUser($user));
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('system.user.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $tryUser = User::where('email',$request->email)->first();
        if($tryUser && $tryUser->id != $id){
            return response()->json(['error' => 'El Email ya fue usado por otro usuario'],401);
        }else{
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            if ($user->save()) {
                return $this->getResponse('success.update');
            }else{
                return $this->getResponse('error.update');
            }
        }
    }

    public function destroy($id)
    {
        if ($user = User::find($id)) {
            if ($user->destroyRelationships()) {
                if ($user->delete()) {
                    return $this->getResponse('success.destroy');
                } else {
                    return $this->getResponse('error.destroy');
                }
            } else {
                return response()->json(['error' => "No se pueden eliminar sus relaciones en base de datos."],401);
            }
        } else {
            return response()->json(['error' => "No existe el usuario."],401);
        }
    }
}
