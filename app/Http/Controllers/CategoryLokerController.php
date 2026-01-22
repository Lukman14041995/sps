<?php

namespace App\Http\Controllers;

use App\Models\CategoryLoker;
use Illuminate\Http\Request;

class CategoryLokerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:master']);
    }

    public function index()
    {
        $data = CategoryLoker::orderBy('id', 'desc')->get();
        return view('admin.category_loker.index', compact('data'));
    }

    public function create()
    {
        return view('admin.category_loker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        CategoryLoker::create($request->only('nama_kategori', 'keterangan'));

        return redirect()
            ->route('admin.category-loker.index')
            ->with('success', 'Category Loker berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = CategoryLoker::findOrFail($id);
        return view('admin.category_loker.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $item = CategoryLoker::findOrFail($id);
        $item->update($request->only('nama_kategori', 'keterangan'));

        return redirect()
            ->route('admin.category-loker.index')
            ->with('success', 'Category Loker berhasil diperbarui');
    }

    public function destroy($id)
    {
        CategoryLoker::destroy($id);

        return redirect()
            ->route('admin.category-loker.index')
            ->with('success', 'Category Loker berhasil dihapus');
    }
}
