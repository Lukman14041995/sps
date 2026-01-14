@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-semibold text-white mb-6">Tambah Bisnis Unit</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-600 text-white px-4 py-3 rounded">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 bg-red-700 text-white px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.bisnis-unit.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-gray-800 p-6 rounded-lg shadow space-y-5">
            @csrf

            {{-- Kategori Bisnis --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Kategori Bisnis</label>
                <select name="bisnis_kategori_id" required
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('bisnis_kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Bisnis Unit --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Nama Bisnis Unit</label>
                <input type="text" name="nama_unit" value="{{ old('nama_unit') }}" required
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Alamat</label>
                <textarea name="alamat" rows="2"
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">{{ old('alamat') }}</textarea>
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            {{-- Telepon --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">No. Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}"
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            {{-- Penanggung Jawab --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Penanggung Jawab (PIC)</label>
                <input type="text" name="pic" value="{{ old('pic') }}"
                    class="w-full rounded bg-gray-700 border border-gray-600 text-white px-3 py-2
                       focus:outline-none focus:ring focus:ring-blue-500">
            </div>

            {{-- Logo --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Logo Bisnis Unit</label>
                <input type="file" name="logo" accept="image/*"
                    class="w-full text-sm text-gray-300
                       file:bg-gray-700 file:border-0 file:px-4 file:py-2
                       file:text-white file:rounded file:cursor-pointer">
                <p class="text-xs text-gray-400 mt-1">Max 2MB (jpg, png, webp)</p>
            </div>

            {{-- Button --}}
            <div class="flex gap-3 pt-2">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Simpan
                </button>

                <a href="{{ route('admin.bisnis-unit.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition">
                    Kembali
                </a>
            </div>

        </form>

    </div>
@endsection
