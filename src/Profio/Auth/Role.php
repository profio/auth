<?php

namespace Profio\Auth;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function menus()
    {
        return $this->belongsToMany('Profio\Auth\Menu', 'menu_role', 'role_id', 'menu_id')->withPivot('workflow_id');
    }

    public function workflows()
    {
        return $this->belongsToMany('Profio\Auth\Workflow', 'menu_role', 'role_id', 'workflow_id')->withPivot('menu_id');
    }

}
