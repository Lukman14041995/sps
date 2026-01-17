@extends('admin.layouts.app')

@section('content')
<div class="bg-gray-800 p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-white">User Management</h1>

        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            + Tambah User
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-gray-900 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-300">
            <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="px-6 py-3">{{ $i + 1 }}</td>
                    <td class="px-6 py-3 font-medium text-white">{{ $user->name }}</td>
                    <td class="px-6 py-3">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        {{ $user->roles->pluck('name')->join(', ') ?: '-' }}
                    </td>
                    <td class="px-6 py-3 text-center space-x-2">

                        {{-- Edit --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus user ini?')"
                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-400">
                        Data user belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
