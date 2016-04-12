<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Menu;
use Profio\Auth\Permission;

class MenuController extends BaseController
{
    public function index()
    {
        $menus = Menu::get()->sortBy('name');
        return view('profio/auth::menu.index', compact('menus'));
    }

    public function create()
    {
        $menu        = new Menu;
        $title       = 'Tambah Menu';
        $permissions = Permission::get()->sortBy('name');
        return view('profio/auth::menu.create', compact('menu', 'title', 'permissions'));
    }

    public function store(Request $request)
    {
        $menu = Menu::create($request->only('name', 'url', 'icon'));

        $permission_ids = $request->input('permission_ids');

        if (count($permission_ids) > 0) {
            $menu->permissions()->sync($permission_ids);
        }

        flash()->success('Menu baru berhasil ditambahkan.');

        return redirect('menu');
    }

    public function edit($id)
    {
        $menu        = Menu::with('permissions')->find($id);
        $title       = 'Ubah Menu';
        $permissions = Permission::get()->sortBy('name');
        return view('profio/auth::menu.create', compact('menu', 'title', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $menu = Menu::find($id);

            $menu->update($request->only('name', 'url', 'icon'));

            $permission_ids = $request->input('permission_ids');

            $menu->permissions()->sync($permission_ids);

            flash()->success('Data Menu berhasil diperbarui.');
        });
        return redirect()->back();
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        flash()->success('Menu berhasil dihapus.');
        return redirect('menu');
    }
}
