<?php

namespace App\Http\Controllers;

use App\Models\CategoryCsr;
use Illuminate\Http\Request;

class CategoryCsrController extends Controller
{
    public function index()
    {
        $data = CategoryCsr::orderBy('id', 'desc')->get();

        return view('category_csr.index', compact('data'));
    }

    public function create()
    {
        return view('category_csr.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        CategoryCsr::create($request->only('nama_kategori', 'keterangan'));

        return redirect()
            ->route('admin.category-csr.index')
            ->with('success', 'Category CSR berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = CategoryCsr::findOrFail($id);

        return view('   category_csr.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $item = CategoryCsr::findOrFail($id);
        $item->update($request->only('nama_kategori', 'keterangan'));

        return redirect()
            ->route('admin.category-csr.index')
            ->with('success', 'Category CSR berhasil diperbarui');
    }

    public function destroy($id)
    {
        CategoryCsr::destroy($id);

        return redirect()->route('admin.category-csr.index')
            ->with('success', 'Kategori CSR berhasil dihapus');
    }
}
