@extends('admin.layouts.app')

@section('title', 'Master Role')

@section('content')
<div class="bg-gray-900 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">Master Role</h2>
        <a href="{{ route('admin.roles.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tambah Role</a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-700 text-gray-200">
        <thead>
            <tr class="bg-gray-800">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Slug</th>
                <th class="border px-4 py-2">Menus</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr class="hover:bg-gray-700">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $role->name }}</td>
                    <td class="border px-4 py-2">{{ $role->slug }}</td>
                    <td class="border px-4 py-2">
                        @foreach($role->menus as $menu)
                            <span class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs mr-1 mb-1">
                                {{ $menu->title }}
                            </span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-blue-400 hover:underline">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline-block ml-2"
                              onsubmit="return confirm('Hapus role ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
