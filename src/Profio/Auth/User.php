<?php

namespace Profio\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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

    public function role()
    {
        return $this->belongsTo('Profio\Auth\Role');
    }

    public function roles()
    {
        return $this->belongsToMany('Profio\Auth\Role');
    }

    public function inRole($name)
    {
        return $this->role->name == $name;
    }

    public function person()
    {
        return $this->morphTo();
    }

    public function menus()
    {
        return $this->role->menus;
    }

    public function sidebarMenu()
    {
        $menus   = $this->menus();
        $parents = $menus->where('parent_id', 0);
        foreach ($parents as $parent) {
            foreach ($menus as $menu) {
                if ($menu->parent_id == $parent->id) {
                    $parent->children->push($menu);
                }
            }

            $parent->children = $parent->children->sortBy('position');
            $children         = $parent->children;
            foreach ($children as $child) {
                foreach ($menus as $menu) {
                    if ($menu->parent_id == $child->id) {
                        $child->children->push($menu);
                    }
                }

                $child->children = $child->children->sortBy('position');
            }
        }

        return $parents;
    }
}
