@extends('admin.layouts.app')
@section('title', 'Tambah User Baru')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= TOAST SUCCESS ================= --}}
        @if (session('success'))
            <div id="success-notification" class="fixed top-4 right-4 z-50">
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-4 max-w-sm animate-slide-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="font-medium text-gray-900">{{ session('success') }}</p>
                            <p class="text-sm text-gray-500 mt-0.5">User berhasil ditambahkan</p>
                        </div>
                        <button type="button" onclick="hideNotification()"
                            class="ml-auto text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div>
                        <h1 class="text-lg sm:text-xl font-bold text-gray-900">Tambah User Baru</h1>
                        <p class="text-gray-500 text-xs sm:text-sm">Buat akun pengguna baru</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= FORM ================= --}}
        <div class="w-full">
            <form method="POST" action="{{ route('admin.users.store') }}" id="userForm" class="space-y-4 sm:space-y-8">
                @csrf

                {{-- INFO DEFAULT PASSWORD --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 text-xs sm:text-sm">
                    <div class="flex items-start">
                        <i class="fas fa-key text-yellow-600 mt-0.5"></i>
                        <div class="ml-3 text-yellow-800">
                            <p class="font-medium">Default Password</p>
                            <p class="mt-1">
                                Password awal:
                                <span class="font-mono bg-white px-2 py-0.5 rounded border border-yellow-300">
                                    $$admin$$
                                </span>
                            </p>
                            <p class="mt-1">
                                Wajib diganti saat login pertama.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- INFORMASI PRIBADI --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-user-circle text-blue-600 mr-2"></i>
                        Informasi Pribadi
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">
                        {{-- NAME --}}
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input name="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm
                            @error('name') border-red-300 @enderror"
                                placeholder="Nama lengkap">
                            @error('name')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email" type="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm
                            @error('email') border-red-300 @enderror"
                                placeholder="email@contoh.com">
                            @error('email')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ROLES --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <div class="flex justify-between mb-3">
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user-tag text-purple-600 mr-2"></i>
                            Role User
                        </h3>
                        <span id="selected-roles-count" class="text-xs sm:text-sm font-medium text-gray-500">
                            0 dipilih
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-3">
                        @foreach ($roles as $role)
                            @php
                                $roleIcons = [
                                    'admin' => 'shield-alt',
                                    'hr' => 'users',
                                    'marketing' => 'bullhorn',
                                    'manager' => 'user-tie',
                                ];
                                $roleColors = [
                                    'admin' => 'bg-red-100 text-red-800',
                                    'hr' => 'bg-green-100 text-green-800',
                                    'marketing' => 'bg-purple-100 text-purple-800',
                                    'manager' => 'bg-blue-100 text-blue-800',
                                ];
                                $icon = $roleIcons[strtolower($role->name)] ?? 'user';
                                $color = $roleColors[strtolower($role->name)] ?? 'bg-gray-100 text-gray-800';
                            @endphp

                            <label
                                class="flex items-center p-2 sm:p-3 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 cursor-pointer transition
                            @if (in_array($role->id, old('roles', []))) border-purple-400 bg-purple-50 @endif">

                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    class="h-4 w-4 sm:h-5 sm:w-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500 mr-2 sm:mr-3 role-checkbox"
                                    onchange="updateSelectedRoles()" @if (in_array($role->id, old('roles', []))) checked @endif>

                                <div class="flex items-center flex-1">
                                    <div
                                        class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg flex items-center justify-center {{ $color }} mr-2 sm:mr-3">
                                        <i class="fas fa-{{ $icon }} text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-xs sm:text-sm">{{ $role->name }}</p>
                                        <p class="text-[10px] sm:text-xs text-gray-500">Akses {{ strtolower($role->name) }}
                                        </p>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- ACTION --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">

                        <div class="flex gap-2 sm:gap-3">
                            <button type="reset"
                                class="flex-1 sm:flex-none px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-xs sm:text-sm">
                                <i class="fas fa-redo mr-1"></i> Reset
                            </button>

                            <a href="{{ route('admin.users.index') }}"
                                class="flex-1 sm:flex-none px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-xs sm:text-sm text-center">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        </div>

                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition text-sm font-medium">
                            <i class="fas fa-user-plus mr-2"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            updateSelectedRoles();
            const notif = document.getElementById('success-notification');
            if (notif) setTimeout(hideNotification, 5000);
        });

        function updateSelectedRoles() {
            const count = document.querySelectorAll('.role-checkbox:checked').length;
            const el = document.getElementById('selected-roles-count');
            if (el) {
                el.textContent = count + ' dipilih';
                el.className = count > 0 ?
                    'text-xs sm:text-sm font-medium text-purple-600' :
                    'text-xs sm:text-sm font-medium text-gray-500';
            }
        }

        function hideNotification() {
            const n = document.getElementById('success-notification');
            if (n) {
                n.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => n.remove(), 300);
            }
        }
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in .3s ease-out;
        }
    </style>
@endsection
