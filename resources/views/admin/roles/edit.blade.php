@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">
                        Edit Role: {{ $role->name }}
                    </h1>
                    <p class="text-gray-500 text-xs sm:text-sm">
                        Perbarui data role dan hak akses menu
                    </p>
                </div>
                <a href="{{ route('admin.roles.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        {{-- ================= FORM ================= --}}
        <div class="w-full">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="space-y-4 sm:space-y-8">
                @csrf
                @method('PUT')

                {{-- BASIC INFO --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-3">
                        Informasi Role
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                Nama Role
                            </label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                Slug
                            </label>
                            <input type="text" name="slug" value="{{ old('slug', $role->slug) }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        </div>
                    </div>
                </div>

                {{-- MENU ACCESS --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <div class="flex justify-between mb-3">
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-900">
                            Menu Akses
                        </h3>
                        <span id="selected-menu-count" class="text-xs sm:text-sm font-medium text-gray-500"></span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-3">
                        @foreach ($menus as $menu)
                            @php
                                $checked = $role->menus->contains($menu->id);
                            @endphp

                            <label
                                class="flex items-center p-2 sm:p-3 rounded-lg border cursor-pointer transition
                            {{ $checked ? 'border-blue-400 bg-blue-50' : 'border-gray-200 hover:border-blue-300 hover:bg-blue-50' }}">

                                <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
                                    class="h-4 w-4 sm:h-5 sm:w-5 rounded border-gray-300 text-blue-600
                                   focus:ring-blue-500 mr-2 sm:mr-3 menu-checkbox"
                                    onchange="updateSelectedMenus()" {{ $checked ? 'checked' : '' }}>

                                <span class="text-xs sm:text-sm text-gray-800">
                                    {{ $menu->title }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">

                        <a href="{{ route('admin.roles.index') }}"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg
                              text-xs sm:text-sm text-center transition">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700
                               text-white rounded-lg shadow transition text-sm font-medium">
                            <i class="fas fa-save mr-2"></i> Update Role
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateSelectedMenus();
        });

        function updateSelectedMenus() {
            const count = document.querySelectorAll('.menu-checkbox:checked').length;
            const el = document.getElementById('selected-menu-count');
            if (el) {
                el.textContent = count + ' dipilih';
                el.className = count > 0 ?
                    'text-xs sm:text-sm font-medium text-blue-600' :
                    'text-xs sm:text-sm font-medium text-gray-500';
            }
        }
    </script>
@endsection
