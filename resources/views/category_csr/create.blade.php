@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-2xl">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-white">Tambah Category CSR</h1>
        <p class="text-sm text-gray-400 mt-1">Isi data kategori CSR dengan benar</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-gray-800 rounded-lg shadow p-6">

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-600 text-white px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.category-csr.store') }}" method="POST">
            @csrf

            {{-- Nama Kategori --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_kategori"
                       value="{{ old('nama_kategori') }}"
                       required
                       class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            {{-- Keterangan --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Keterangan
                </label>
                <textarea name="keterangan" rows="4"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('keterangan') }}</textarea>
            </div>

            {{-- Action --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.category-csr.index') }}"
                   class="text-gray-300 hover:text-white transition">
                    ← Kembali
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
