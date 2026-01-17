@extends('admin.layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="p-6 bg-gray-900 rounded-lg shadow max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4 text-white">Tambah Menu</h2>

    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Route</label>
            <input type="text" name="route" value="{{ old('route') }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Icon (FontAwesome)</label>
            <input type="text" name="icon" value="{{ old('icon') }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Roles (pisahkan koma)</label>
            <input type="text" name="roles" value="{{ old('roles') }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Order</label>
            <input type="number" name="order" value="{{ old('order', 0) }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Parent Menu</label>
            <select name="parent_id" class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
                <option value="">— None —</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-200">Count (optional)</label>
            <input type="number" name="count" value="{{ old('count') }}"
                   class="w-full border border-gray-700 bg-gray-800 text-gray-200 px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Simpan
        </button>
        <a href="{{ route('admin.menus.index') }}" class="ml-2 text-gray-300 hover:underline">Batal</a>
    </form>
</div>
@endsection
