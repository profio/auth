<?php

namespace Profio\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Menu extends Model
{
    protected $table = 'menus';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    public $children = null;

    protected $fillable = ['name', 'url', 'icon'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->children = new Collection;
    }

    public function roles()
    {
        return $this->belongsToMany('Profio\Auth\Role', 'menu_role', 'menu_id', 'role_id');
    }

    public function workflows()
    {
        return $this->belongsToMany('Profio\Auth\Workflow', 'menu_role', 'menu_id', 'workflow_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('Profio\Auth\Permission', 'menu_permission');
    }

}
