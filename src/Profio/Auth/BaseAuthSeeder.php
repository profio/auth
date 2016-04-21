<?php

namespace Profio\Auth;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BaseAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('secret'),
        ]);

        $role = Role::create([
            'name' => 'administrator', 
            'display_name' => 'Administrator', 
        ]);

        $menu = $role->addMenu('Menu', 'menu');
        $menu->addPermission('manage-menu', 'Menu Index');
        $menu->addPermission('create-menu', 'Menu Create');
        $menu->addPermission('edit-menu', 'Menu Edit');
        $menu->addPermission('delete-menu', 'Menu Delete');

        $menu = $role->addMenu('Permission', 'permission');
        $menu->addPermission('manage-permission', 'Permission Index');
        $menu->addPermission('create-permission', 'Permission Create');
        $menu->addPermission('edit-permission', 'Permission Edit');
        $menu->addPermission('delete-permission', 'Permission Delete');

        $menu = $role->addMenu('Role', 'role');
        $menu->addPermission('manage-role', 'Role Index');
        $menu->addPermission('create-role', 'Role Create');
        $menu->addPermission('edit-role', 'Role Edit');
        $menu->addPermission('delete-role', 'Role Delete');
        
        $menu = $role->addMenu('Workflow', 'workflow');
        $menu->addPermission('manage-workflow', 'Workflow Index');
        $menu->addPermission('create-workflow', 'Workflow Create');
        $menu->addPermission('edit-workflow', 'Workflow Edit');
        $menu->addPermission('delete-workflow', 'Workflow Delete');
        $menu->addPermission('mapping-workflow', 'Workflow Mapping');
        Model::reguard();
    }
}
