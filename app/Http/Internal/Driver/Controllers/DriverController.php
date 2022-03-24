<?php

namespace App\Http\Internal\Driver\Controllers;

use App\Domain\Internal\Driver\Driver;
use App\Domain\System\User\User;
use App\Http\Internal\Driver\Requests\DriverRequest;
use App\App\Controllers\Controller;
use Sentinel;

class DriverController extends Controller
{
    public function index()
    {
        return view('internal.driver.index');
    }

    public function create()
    {
        return view('internal.driver.create');
    }

    public function store(DriverRequest $request)
    {
        if ($user = Sentinel::registerAndActivate(array_merge($request->all(),[
            'password' => explode('@',$request->email)[0]
        ]))) {
            Driver::create([
                'user_id' => $user->id,
                'rut'=> $request->rut
            ]);
            $role = Sentinel::findRoleBySlug('driver');
            $user->roles()->attach($role->id);
            //event(new AdminRegistersUser($user));
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        $user = User::findOrFail($driver->user_id);
        return view('internal.driver.edit',compact('user','driver'));
    }

    public function update(DriverRequest $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $user = User::find($driver->id);
        $tryUser = User::where('email',$request->email)->first();
        if($tryUser && $tryUser->id != $id){
            return response()->json(['error' => 'El Email ya fue usado por otro usuario'],401);
        }else{
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            if ($user->save()) {
                $driver->update([
                    'user_id' => $user->id,
                    'rut' => $request->rut
                ]);
                return $this->getResponse('success.update');
            }else{
                return $this->getResponse('error.update');
            }
        }
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        if ($user = User::find($driver->user_id)) {
            $driver->delete();
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
