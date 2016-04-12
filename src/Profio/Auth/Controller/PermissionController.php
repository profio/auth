<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Permission;

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
        $title      = 'Tambah Permission';
        return view('profio/auth::permission.create', compact('permission', 'title'));
    }

    public function store(Request $request)
    {
        Permission::create($request->only('name', 'display_name', 'description'));
        flash()->success('Permission baru berhasil ditambahkan.');
        return redirect('permission');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $title      = 'Ubah Permission';
        return view('profio/auth::permission.create', compact('permission', 'title'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $permission = Permission::find($id);
            $permission->update($request->only('name', 'display_name', 'description'));
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
