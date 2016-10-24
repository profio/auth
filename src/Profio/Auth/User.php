<?php

namespace Profio\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Profio\Auth\Role;

class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, UserTrait, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setActiveRole(Role $role)
    {
        $this->role()->associate($role)->save();
    }

    public function role()
    {
        return $this->belongsTo('Profio\Auth\Role');
    }

    public function getActiveRole()
    {
        $role = $this->role;
        if (is_null($role)) {
            $role = $this->roles()->first();
            if (!is_null($role)) {
                $this->role()->associate($role)->save();
            }
        } else {
            if (!$this->roles()->where('id', $role->id)->exists()) {
                $this->role_id = null;
                $this->save();
                
                $role = $this->getActiveRole();
            }
        }

        return $role;
    }

    public function roles()
    {
        return $this->belongsToMany('Profio\Auth\Role');
    }

    public function inRole($name)
    {
        return $this->role->name == $name;
    }

    public function sidebarMenu()
    {
        $activeRole = $this->getActiveRole();
        if (is_null($activeRole)) {
            return collect();
        }

        return $activeRole->sidebarMenu();
    }
}
