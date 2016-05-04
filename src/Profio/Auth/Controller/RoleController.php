<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Menu;
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

    public function manageMenu($id, Request $request)
    {
        if ($request->isMethod('get')) {
            $role = Role::findOrFail($id);
            return view('profio/auth::role.manage-menu', compact('role'));
        } else {
            $menus = $request->get('menus');
            $parents = $request->get('parents');
            
            for ($i = 0; $i < count($menus); $i++) {
                $menu =  Menu::find($menus[$i]);
                $menu->position = $i + 1;
                $menu->parent()->associate(Menu::find($parents[$i]));
                $menu->save();
            }

            return redirect()->back();
        }
    }
}
