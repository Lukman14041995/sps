@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-gray-900 rounded-xl shadow">

    <h1 class="text-2xl font-semibold text-white mb-6">Edit Bisnis Unit</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-700 text-white px-4 py-3 rounded">
            <ul class="list-disc ml-4 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bisnis-unit.update', $item->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Kategori Bisnis --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Kategori Bisnis
            </label>
            <select name="bisnis_kategori_id" required
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ old('bisnis_kategori_id', $item->bisnis_kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nama Unit --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Nama Bisnis Unit
            </label>
            <input type="text" name="nama_unit"
                value="{{ old('nama_unit', $item->nama_unit) }}" required
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">
        </div>

        {{-- Alamat --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Alamat
            </label>
            <textarea name="alamat" rows="2"
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">{{ old('alamat', $item->alamat) }}</textarea>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Email
            </label>
            <input type="email" name="email"
                value="{{ old('email', $item->email) }}"
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">
        </div>

        {{-- Telepon --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                No. Telepon
            </label>
            <input type="text" name="telepon"
                value="{{ old('telepon', $item->telepon) }}"
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">
        </div>

        {{-- PIC --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Penanggung Jawab (PIC)
            </label>
            <input type="text" name="pic"
                value="{{ old('pic', $item->pic) }}"
                class="w-full rounded-lg bg-gray-800 border border-gray-600 text-white px-3 py-2 focus:ring focus:ring-blue-500">
        </div>

        {{-- Logo Lama --}}
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Logo Saat Ini
            </label>
            @if ($item->logo)
                <img src="{{ Storage::disk('s3')->url($item->logo) }}"
                     class="h-20 bg-white p-2 rounded shadow">
            @else
                <p class="text-gray-400 text-sm">Belum ada logo</p>
            @endif
        </div>

        {{-- Upload Logo Baru --}}
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-200">
                Ganti Logo (Opsional)
            </label>
            <input type="file" name="logo" accept="image/*"
                class="w-full text-sm text-gray-300
                       file:bg-gray-700 file:border-0 file:px-4 file:py-2
                       file:text-white file:rounded-lg file:hover:bg-gray-600">
            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti</p>
        </div>

        {{-- Button --}}
        <div class="flex gap-3">
            <button
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                Update
            </button>

            <a href="{{ route('admin.bisnis-unit.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection
