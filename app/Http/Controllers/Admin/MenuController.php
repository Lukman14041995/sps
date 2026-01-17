<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')->orderBy('order')->with('children')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'route' => 'nullable|string',
            'icon'  => 'nullable|string',
            'roles' => 'nullable|string',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
            'count' => 'nullable|integer',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')->where('id','!=',$menu->id)->get();
        return view('admin.menus.edit', compact('menu','parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string',
            'route' => 'nullable|string',
            'icon'  => 'nullable|string',
            'roles' => 'nullable|string',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
            'count' => 'nullable|integer',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}

