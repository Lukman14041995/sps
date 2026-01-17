@extends('admin.layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="p-6 bg-gray-900 rounded-lg shadow max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4 text-white">Edit Menu</h2>

    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Title</label>
            <input type="text" name="title" value="{{ old('title', $menu->title) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Route</label>
            <input type="text" name="route" value="{{ old('route', $menu->route) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Icon (FontAwesome)</label>
            <input type="text" name="icon" value="{{ old('icon', $menu->icon) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Roles (pisahkan koma)</label>
            <input type="text" name="roles" value="{{ old('roles', $menu->roles) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Order</label>
            <input type="number" name="order" value="{{ old('order', $menu->order) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Parent Menu</label>
            <select name="parent_id" 
                    class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
                <option value="">— None —</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Count (optional)</label>
            <input type="number" name="count" value="{{ old('count', $menu->count) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Update
        </button>
        <a href="{{ route('admin.menus.index') }}" class="ml-2 text-gray-300 hover:underline">Batal</a>
    </form>
</div>
@endsection
