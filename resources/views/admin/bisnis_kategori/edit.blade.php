@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    <h1 class="text-2xl font-semibold text-white mb-6">
        Edit Bisnis Kategori
    </h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-600 text-white px-4 py-3 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bisnis-kategori.update', $item->id) }}" method="POST"
          class="bg-gray-800 p-6 rounded-lg shadow space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 text-sm text-gray-300">Nama Kategori</label>
            <input type="text" name="nama_kategori"
                value="{{ old('nama_kategori', $item->nama_kategori) }}"
                class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500"
                required>
        </div>

        <div>
            <label class="block mb-1 text-sm text-gray-300">Keterangan</label>
            <textarea name="keterangan" rows="4"
                class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500">{{ old('keterangan', $item->keterangan) }}</textarea>
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                Update
            </button>

            <a href="{{ route('admin.bisnis-kategori.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg transition">
                Kembali
            </a>
        </div>

    </form>
</div>
@endsection
