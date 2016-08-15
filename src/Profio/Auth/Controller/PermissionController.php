<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Permission;
use Profio\Auth\Role;

class PermissionController extends BaseController
{
    public function index()
    {
        $permissions = Permission::get()->sortBy('name');
        return view('profio/auth::permission.index', compact('permissions'));
    }

    public function create()
    {
        $permission = new Permission;
        $title      = 'Add Permission';
        $roles      = Role::get()->sortBy('name');
        return view('profio/auth::permission.create', compact('permission', 'title', 'roles'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $permission = Permission::create($request->only('name', 'display_name', 'description'));
        $role_ids = $request->input('role_ids') ?: [];
        $permission->roles()->sync($role_ids);
        DB::commit();

        flash()->success('Permission baru berhasil ditambahkan.');
        return redirect('permission');
    }

    public function edit($id)
    {
        $permission = Permission::with('roles')->find($id);
        $title      = 'Edit Permission';
        $roles      = Role::get()->sortBy('name');
        return view('profio/auth::permission.create', compact('permission', 'title', 'roles'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $permission = Permission::find($id);
            $permission->update($request->only('name', 'display_name', 'description'));
            $role_ids = $request->input('role_ids') ?: [];
            $permission->roles()->sync($role_ids);
            flash()->success('Data Permission berhasil diperbarui.');
        });
        return redirect()->back();
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        flash()->success('Permission berhasil dihapus.');
        return redirect('permission');
    }
}
