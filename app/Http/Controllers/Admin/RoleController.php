<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', ['roles' => Role::all()]);
    }

    public function create()
    {
        return view('admin.roles.create', ['menus' => Menu::all()]);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name', 'slug'));
        $role->menus()->sync($request->menus ?? []);
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dibuat');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'menus' => Menu::all(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->only('name', 'slug'));
        $role->menus()->sync($request->menus ?? []);
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy(Role $role)
    {
        $role->menus()->detach();
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dihapus');
    }
}
