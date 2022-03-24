<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert($this->getMenusArray());
        $this->assignMenuRoles();
    }

    public function assignMenuRoles()
    {
    	$menus = \App\Domain\System\Menu\Menu::get();
    	$role = Sentinel::findRoleBySlug('super-admin');
    	foreach($menus as $menu) {
			$menu->roles()->attach($role->id);
	    }
    }

    public function getMenusArray()
    {
    	return [
    		[
    			'name' => 'Inicio',
			    'slug' => 'inicio',
			    'route' => 'home',
			    'icon' => 'home',
			    'parent_id' => null,
			    'position' => 0,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Sistema',
			    'slug' => 'sistema',
			    'route' => null,
			    'icon' => 'wrench',
			    'parent_id' => null,
			    'position' => 1,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Menu Principal',
			    'slug' => 'menu-principal',
			    'route' => 'menus.index',
			    'icon' => 'bars',
			    'parent_id' => 2,
			    'position' => 3,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Usuarios',
			    'slug' => 'usuarios',
			    'route' => 'users.index',
			    'icon' => 'users',
			    'parent_id' => 2,
			    'position' => 0,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Roles',
			    'slug' => 'roles',
			    'route' => 'roles.index',
			    'icon' => 'key',
			    'parent_id' => 2,
			    'position' => 1,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Permisos',
			    'slug' => 'permisos',
			    'route' => 'permissions.index',
			    'icon' => 'th-list',
			    'parent_id' => 2,
			    'position' => 2,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Imports',
			    'slug' => 'imports',
			    'route' => 'imports.index',
			    'icon' => 'database',
			    'parent_id' => 2,
			    'position' => 3,
			    'type' => 'main-menu'
		    ],
		    [
			    'name' => 'Importar',
			    'slug' => 'importar',
			    'route' => 'imports.show-all',
			    'icon' => 'cloud-upload-alt',
			    'parent_id' => null,
			    'position' => 2,
			    'type' => 'main-menu'
		    ],

	    ];
    }
}
