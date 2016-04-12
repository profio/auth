<?php

namespace Profio\Auth;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function workflows()
    {
        return $this->belongsToMany('Profio\Auth\Workflow', 'permission_role', 'permission_id', 'workflow_id');
    }

    public function menu()
    {
        return $this->belongsToMany('Profio\Auth\Menu', 'menu_permission');
    }
}
