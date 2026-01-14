<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BisnisKategori;
use Illuminate\Http\Request;

class BisnisKategoriController extends Controller
{
    public function index()
    {
        $data = BisnisKategori::orderBy('id')->get();
        return view('admin.bisnis_kategori.index', compact('data'));
    }

    public function create()
    {
        return view('admin.bisnis_kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        BisnisKategori::create($request->all());

        return redirect()->route('admin.bisnis-kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = BisnisKategori::findOrFail($id);
        return view('admin.bisnis_kategori.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $item = BisnisKategori::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.bisnis-kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        BisnisKategori::destroy($id);

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus');
    }
}
