<?php

namespace Profio\Auth;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    protected $table = 'workflows';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    public function menus()
    {
        return $this->belongsToMany('Profio\Auth\Menu', 'menu_role', 'workflow_id', 'menu_id')->withPivot('role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('Profio\Auth\Permission', 'permission_role', 'workflow_id', 'permission_id')->withPivot('role_id');
    }

}
