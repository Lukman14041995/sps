@extends('admin.layouts.app')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-white">Master Category Loker</h1>

        <a href="{{ route('admin.category-loker.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-600 text-white px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-300">
            <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Kategori</th>
                    <th class="px-6 py-3">Keterangan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="px-6 py-3">{{ $i+1 }}</td>
                    <td class="px-6 py-3 font-medium text-white">{{ $row->nama_kategori }}</td>
                    <td class="px-6 py-3">{{ $row->keterangan ?? '-' }}</td>
                    <td class="px-6 py-3 text-center space-x-2">

                        <a href="{{ route('admin.category-loker.edit', $row->id) }}"
                           class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.category-loker.destroy', $row->id) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data ini?')"
                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                        Data kategori belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
