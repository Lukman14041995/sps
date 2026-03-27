@extends('admin.layouts.app')

@section('title', 'Edit Menu')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Edit Menu</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Perbarui data menu</p>
                </div>
                <a href="{{ route('admin.menus.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        {{-- ================= FORM ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-6 w-full">

            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- TITLE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $menu->title) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                </div>

                {{-- ROUTE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Route</label>
                    <input type="text" name="route" value="{{ old('route', $menu->route) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm"
                        placeholder="contoh: admin.users.index">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika menu hanya parent</p>
                </div>

                {{-- ICON + PREVIEW --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Icon (FontAwesome)</label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="iconInput" value="{{ old('icon', $menu->icon) }}"
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2
                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm"
                            placeholder="fas fa-users">
                        <div class="w-10 h-10 rounded-lg border flex items-center justify-center bg-gray-50">
                            <i id="iconPreview"
                                class="{{ old('icon', $menu->icon) ?: 'fas fa-circle-question' }} text-gray-600"></i>
                        </div>
                    </div>
                </div>

                {{-- ORDER --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                    <input type="number" name="order" value="{{ old('order', $menu->order) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                    <p class="text-xs text-gray-500 mt-1">Semakin kecil, semakin atas posisinya</p>
                </div>

                {{-- PARENT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Parent Menu</label>
                    <select name="parent_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        <option value="">— Menu Utama —</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- COUNT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Count (optional)</label>
                    <input type="number" name="count" value="{{ old('count', $menu->count) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                              focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                </div>

                {{-- ACTION --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">

                    <a href="{{ route('admin.menus.index') }}"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                        <i class="fas fa-save mr-1"></i> Update Menu
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        document.getElementById('iconInput').addEventListener('input', function() {
            const preview = document.getElementById('iconPreview');
            preview.className = this.value || 'fas fa-circle-question';
        });
    </script>
@endsection
