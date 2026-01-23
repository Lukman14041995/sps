@extends('admin.layouts.app')
@section('title', 'Edit User')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div>
                        <h1 class="text-lg sm:text-xl font-bold text-gray-900">Edit User</h1>
                        <p class="text-gray-500 text-xs sm:text-sm">Perbarui data pengguna</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= FORM ================= --}}
        <div class="w-full">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-4 sm:space-y-8">
                @csrf
                @method('PUT')

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
                            <input name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm">
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
                        <span id="selected-roles-count" class="text-xs sm:text-sm font-medium text-gray-500"></span>
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
                                $checked = in_array($role->id, $user->roles->pluck('id')->toArray());
                            @endphp

                            <label
                                class="flex items-center p-2 sm:p-3 rounded-lg border cursor-pointer transition
                            {{ $checked ? 'border-purple-400 bg-purple-50' : 'border-gray-200 hover:border-purple-300 hover:bg-purple-50' }}">

                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    class="h-4 w-4 sm:h-5 sm:w-5 rounded border-gray-300 text-purple-600 focus:ring-purple-500 mr-2 sm:mr-3 role-checkbox"
                                    onchange="updateSelectedRoles()" {{ $checked ? 'checked' : '' }}>

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

                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition text-xs sm:text-sm text-center">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition text-sm font-medium">
                            <i class="fas fa-save mr-2"></i> Update User
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
    </script>
@endsection
