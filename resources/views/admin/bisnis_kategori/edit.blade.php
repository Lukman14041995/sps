@extends('admin.layouts.app')

@section('title', 'Edit Bisnis Kategori')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Edit Bisnis Kategori</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Perbarui data kategori bisnis</p>
                </div>
                <a href="{{ route('admin.bisnis-kategori.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        {{-- ================= ERROR ALERT ================= --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ================= FORM ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-6 w-full">

            <form action="{{ route('admin.bisnis-kategori.update', $item->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- NAMA KATEGORI --}}
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $item->nama_kategori) }}"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm"
                        required>
                </div>

                {{-- KETERANGAN --}}
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" rows="4"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300
                                 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">{{ old('keterangan', $item->keterangan) }}</textarea>
                </div>

                {{-- ACTION --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">

                    <a href="{{ route('admin.bisnis-kategori.index') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>

                </div>

            </form>
        </div>
    </div>
@endsection
