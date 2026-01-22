@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-2xl">

    <h1 class="text-2xl font-semibold text-white mb-6">Tambah Category Loker</h1>

    <div class="bg-gray-800 rounded-lg shadow p-6">

        @if ($errors->any())
            <div class="mb-4 bg-red-600 text-white px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.category-loker.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-sm text-gray-300 mb-1">Nama Kategori *</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required
                       class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-gray-300 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="4"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600">{{ old('keterangan') }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.category-loker.index') }}" class="text-gray-300">← Kembali</a>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Simpan</button>
            </div>
        </form>

    </div>
</div>
@endsection
