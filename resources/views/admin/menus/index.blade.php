@extends('admin.layouts.app')

@section('title', 'Master Menu')

@section('content')
<div class="bg-gray-900 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">Master Menu</h2>
        <a href="{{ route('admin.menus.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambah Menu</a>
    </div>

    @if(session('success'))
        <div class="bg-green-700 text-green-100 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-700 text-gray-200">
            <thead>
                <tr class="bg-gray-800">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Route</th>
                    <th class="border px-4 py-2">Icon</th>
                    <th class="border px-4 py-2">Roles</th>
                    <th class="border px-4 py-2">Order</th>
                    <th class="border px-4 py-2">Parent</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr class="hover:bg-gray-800">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $menu->title }}</td>
                        <td class="border px-4 py-2">{{ $menu->route }}</td>
                        <td class="border px-4 py-2">{{ $menu->icon }}</td>
                        <td class="border px-4 py-2">{{ $menu->roles }}</td>
                        <td class="border px-4 py-2">{{ $menu->order }}</td>
                        <td class="border px-4 py-2">{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                        <td class="border px-4 py-2 flex items-center space-x-2">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Hapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Loop children --}}
                    @foreach($menu->children as $child)
                        <tr class="bg-gray-800 hover:bg-gray-700">
                            <td class="border px-4 py-2">{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 ml-4">— {{ $child->title }}</td>
                            <td class="border px-4 py-2">{{ $child->route }}</td>
                            <td class="border px-4 py-2">{{ $child->icon }}</td>
                            <td class="border px-4 py-2">{{ $child->roles }}</td>
                            <td class="border px-4 py-2">{{ $child->order }}</td>
                            <td class="border px-4 py-2">{{ $child->parent->title }}</td>
                            <td class="border px-4 py-2 flex items-center space-x-2">
                                <a href="{{ route('admin.menus.edit', $child->id) }}" class="text-blue-400 hover:underline">Edit</a>
                                <form action="{{ route('admin.menus.destroy', $child->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
