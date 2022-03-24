<?php

namespace App\Http\System\Menu\Controllers;

use App\Domain\System\Menu\Menu;
use App\Domain\System\Role\Role;
use App\Http\System\Menu\Requests\StoreMenuRequest;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('system.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $menus = Menu::where('type','main-menu')->with('roles')->whereNotNull('icon')->orderBy('position')->get();
        return view('system.menu.create', compact(['roles','menus']));
    }

    public function store(StoreMenuRequest $request)
    {
        $roles = $request->roles;
        if (!$roles) {
            return response()->json(['error' => 'Debe seleccionar un Role'],401);
        } else {
            $lastMenu = Menu::orderBy('id','desc')->first();
            if ($menu = Menu::create(array_merge($request->all(), [
                'slug' => str_slug($request->name),
                'type' => 'main-menu',
                'position' => (isset($lastMenu))?$lastMenu->position +1:0
            ]))) {
                $menu->attachRoles($roles);
                return $this->getResponse('success.store');
            } else {
                return $this->getResponse('error.store');
            }
        }
    }

    public function edit($id)
    {
        $menu = Menu::with('roles')->find($id);
        $roles = Role::get();
        $menus = Menu::where('type','main-menu')->with('roles')->whereNotNull('icon')->orderBy('position')->get();
        return view('system.menu.edit', compact(['menu','menus','roles']));
    }


    public function update(StoreMenuRequest $request, $id)
    {
        $roles = $request->roles;
        $menu = Menu::find($id);
        if(!$roles) {
            return response()->json(['Error' => 'Debe seleccionar almenos 1 Role'],401);
        } else {
            if ($menu->update(array_merge($request->all(),[
                'slug' => str_slug($request->name),
            ]))) {
                $menu->detachAllRoles();
                $menu->attachRoles($roles);
                return $this->getResponse('success.update');
            } else {
                return $this->getResponse('error.update');
            }
        }

    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        if($menu->detachAllRoles()) {
            if (Menu::destroy($id)) {
                return $this->getResponse('success.destroy');
            } else {
                return $this->getResponse('error.destroy');
            }
        } else {
            return response()->json(['error' => 'No puede ser desvicunlado de los Roles'],401);
        }
    }
}
