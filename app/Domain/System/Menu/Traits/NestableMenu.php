<?php

namespace App\Domain\System\Menu\Traits;

use App\Domain\System\Menu\Menu;

trait NestableMenu
{
    protected $menus;

    public  function generateMenu()
    {
        $menus = $this->getNested();
        return view('layouts.main.partials.mainMenu',compact('menus'));
    }
    public function getNested($parent = 0){
        $this->setMenu();
        $filtered = $this->menus->filter(function ($value, $key) use ($parent) {
            return $value->parent_id == $parent;
        });

        $menu = array();
        foreach ($filtered as $f){
            $item = array ();
            $item = $f->toArray();
            if ($f->userHasPermission()) {
                $item['children'] = $this->getNested($f['id']);
                if (isActiveRoute($f->route) && $f->route != null) {
                    $item['class'] = 'active';
                } else {
                    $item['class'] = '';
                }
                if (count($item['children']) > 0) {
                    foreach ($item['children'] as $child) {
                        if ($child['class'] == 'active') {
                            $item['class'] = 'open active';
                        }
                    }
                }
                array_push($menu, $item);
            }
        }
        return $menu;
    }

    protected function setMenu()
    {
        $this->menus = Menu::getMenu();
    }
}
