<?php

namespace Profio\Auth;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    private $permissions = null;
    protected $fillable = ['name', 'display_name', 'description'];

    public function menus()
    {
        return $this->belongsToMany('Profio\Auth\Menu', 'menu_role', 'role_id', 'menu_id')->withPivot('workflow_id');
    }

    public function getPermissions()
    {
        $menus = $this->menus;
        $this->permissions = collect();

        foreach ($menus as $menu) {
            $this->permissions = $this->permissions->merge($menu->permissions);

            if ($menu->child()->count()) {
                foreach ($menu->child() as $child) {
                    $this->permissions = $this->permissions->merge($child->permissions);
                    
                    if ($child->child()->count()) {
                        foreach ($child->child() as $grandChild) {
                            $this->permissions = $this->permissions->merge($grandChild->permissions);
                            
                        }
                    }
                }
            }
        }

        return $this->permissions;
    }

    public function workflows()
    {
        return $this->belongsToMany('Profio\Auth\Workflow', 'menu_role', 'role_id', 'workflow_id')->withPivot('menu_id');
    }

    public function addMenu($name, $url, $icon = null, $parent = null)
    {
    	$menu = new Menu;
    	$menu->name = $name;
    	$menu->url = $url;
    	$menu->icon = $icon;

    	if (!($parent instanceof Menu)) {
    		$parent = Menu::find($parent);
    	}

    	if (!is_null($parent)) {
    		$menu->parent()->associate($menu);
    	}

    	$menu->save();
    	$this->menus()->attach($menu);

    	return $menu;
    }

}
