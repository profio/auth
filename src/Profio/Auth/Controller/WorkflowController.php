<?php

namespace Profio\Auth\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Profio\Auth\Menu;
use Profio\Auth\Role;
use Profio\Auth\Workflow;

class WorkflowController extends BaseController
{
    public function index()
    {
        $workflows = Workflow::get()->sortBy('name');
        return view('profio/auth::workflow.index', compact('workflows'));
    }

    public function create()
    {
        $workflow = new Workflow;
        $title    = 'Tambah Aliran Kerja';
        return view('profio/auth::workflow.create', compact('workflow', 'title'));
    }

    public function store(Request $request)
    {
        Workflow::create($request->only('name', 'description'));
        flash()->success('Aliran Kerja baru berhasil ditambahkan.');
        return redirect('workflow');
    }

    public function edit($id)
    {
        $workflow = Workflow::find($id);
        $title    = 'Ubah Aliran Kerja';
        return view('profio/auth::workflow.create', compact('workflow', 'title'));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $workflow = Workflow::find($id);
            $workflow->update($request->only('name', 'description'));
            flash()->success('Data jurusan berhasil diperbarui.');
        });
        return redirect()->back();
    }

    public function mapping($id, Request $request)
    {
        $workflow = Workflow::find($id);
        if ($request->isMethod('get')) {
            $workflow->load('menus');
            $title = 'Pemetaan Proses Aliran Kerja';
            $roles = Role::get()->pluck('display_name', 'id');
            $menus = Menu::get()->pluck('name', 'id');
            return view('profio/auth::workflow.mapping', compact('workflow', 'title', 'roles', 'menus'));
        } else {
            $workflow->menus()->detach();
            $workflow->permissions()->detach();
            $role_ids = $request->input('role_ids');
            $menu_ids = $request->input('menu_ids');
            DB::transaction(function () use ($role_ids, $workflow, $menu_ids) {
                foreach ($role_ids as $key => $role_id) {
                    $workflow->menus()->attach($menu_ids[$key], ['role_id' => $role_id]);
                    $menu = Menu::find($menu_ids[$key]);
                    foreach ($menu->permissions as $permission) {
                        $workflow->permissions()->attach($permission->id, ['role_id' => $role_id]);
                    }
                }

                flash()->success('Pemetaan proses aliran kerja berhasil disimpan.');
            });

            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Workflow::destroy($id);
        flash()->success('Aliran Kerja berhasil dihapus.');
        return redirect('workflow');
    }
}
