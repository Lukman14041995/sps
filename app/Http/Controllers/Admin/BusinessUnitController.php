<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ✅ WAJIB
use App\Models\BisnisKategori;
use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessUnitController extends Controller
{
    public function index()
    {
        $data = BusinessUnit::with('kategori')->latest()->get();

        return view('admin.business-unit.index', compact('data'));
    }

    public function create()
    {
        $kategori = BisnisKategori::orderBy('nama_kategori')->get();

        return view('admin.business-unit.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bisnis_kategori_id' => 'required|exists:bisnis_kategoris,id',
            'nama_unit' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'deskripsi' => 'nullable|string',

            // upload logo
            'logo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
        ]);

        try {

            // ✅ Upload logo ke MinIO (S3)
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $path = $request->file('logo')
                    ->store('business-unit/logo', 's3');

                $validated['logo'] = $path;
            }

            $validated['created_by'] = Auth::id();

            BusinessUnit::create($validated);

            return redirect()
                ->route('admin.bisnis-unit.index') // ✅ BENAR
                ->with('success', 'Business Unit berhasil ditambahkan');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan Business Unit. Error: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $item = BusinessUnit::findOrFail($id);
        $kategori = BisnisKategori::orderBy('nama_kategori')->get();

        return view('admin.business-unit.edit', compact('item', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $item = BusinessUnit::findOrFail($id);

        $validated = $request->validate([
            'bisnis_kategori_id' => 'required|exists:bisnis_kategoris,id',
            'nama_unit' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,webp',
        ]);

        try {

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

                // hapus file lama di MinIO
                if ($item->logo) {
                    Storage::disk('s3')->delete($item->logo);
                }

                $path = $request->file('logo')
                    ->store('business-unit/logo', 's3');

                $validated['logo'] = $path;
            }

            $item->update($validated);

            return redirect()
                ->route('admin.bisnis-unit.index')
                ->with('success', 'Business Unit berhasil diperbarui');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal update Business Unit. Error: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        $item = BusinessUnit::findOrFail($id);

        if ($item->logo) {
            Storage::disk('public')->delete($item->logo);
        }

        $item->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
