@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="bg-gray-900 p-6 rounded-lg shadow max-w-2xl mx-auto">
    <h2 class="text-xl font-bold text-white mb-4">Edit Role: {{ $role->name }}</h2>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Nama Role</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}"
                   class="w-full px-3 py-2 rounded border border-gray-700 bg-gray-800 text-white"
                   required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $role->slug) }}"
                   class="w-full px-3 py-2 rounded border border-gray-700 bg-gray-800 text-white"
                   required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium text-gray-200">Menu Akses</label>
            <div class="grid grid-cols-2 gap-2 max-h-64 overflow-y-auto">
                @foreach($menus as $menu)
                    <label class="flex items-center space-x-2 bg-gray-800 p-2 rounded hover:bg-gray-700">
                        <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
                               class="form-checkbox text-blue-500"
                               {{ $role->menus->contains($menu->id) ? 'checked' : '' }}>
                        <span class="text-gray-200">{{ $menu->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</button>
            <a href="{{ route('admin.roles.index') }}" class="ml-4 text-gray-400 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
