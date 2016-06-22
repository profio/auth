<?php

namespace Profio\Auth;

use Profio\Auth\Menu;
use Profio\Auth\Role;

class AuthService
{
	public function addAccesss(Role $role, Menu $menu, $permission_ids = [])
	{
		$menu->roles()->attach($role->id);

		if (count($permission_ids) > 0) {
		    $role->permissions()->attach($permission_ids);
		}
	}
}
