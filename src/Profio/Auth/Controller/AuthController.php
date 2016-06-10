<?php

namespace Profio\Auth\Controller;

use Profio\Auth\Role;

class AuthController extends BaseController
{
	public function postChangeRole()
	{
		$role = \Auth::user()->roles()->where('id', request('role_id'))->first();
		if (!is_null($role)) {
			\Auth::user()->setActiveRole($role);
			return redirect('/');
		}
	}
}