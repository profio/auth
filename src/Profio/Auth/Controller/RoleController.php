<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Role;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::get()->sortBy('name');
        return view('profio/auth::role.index', compact('roles'));
    }

    public function create()
    {
        $role  = new Role;
        $title = 'Tambah Role';
        return view('profio/auth::role.create', compact('role', 'title'));
    }

    public function store(Request $request)
    {
        Role::create($request->only('name', 'display_name', 'description'));
        flash()->success('Role baru berhasil ditambahkan.');
        return redirect('role');
    }

    public function edit($id)
    {
        $role  = Role::find($id);
        $title = 'Ubah Role';
        return view('profio/auth::role.create', compact('role', 'title'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $role = Role::find($id);
            $role->update($request->only('name', 'display_name', 'description'));
            flash()->success('Data peran berhasil diperbarui.');
        });
        return redirect()->back();
    }

    public function destroy($id)
    {
        Role::destroy($id);
        flash()->success('Role berhasil dihapus.');
        return redirect('role');
    }
}
