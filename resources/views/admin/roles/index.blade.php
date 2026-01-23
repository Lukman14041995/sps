@extends('admin.layouts.app')

@section('title', 'Master Role')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= TOAST SUCCESS ================= --}}
        @if (session('success'))
            <div id="toast-success"
                class="fixed top-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center animate-slide">
                <i class="fas fa-check-circle mr-2"></i>
                <span class="text-sm">{{ session('success') }}</span>
                <button onclick="closeToast()" class="ml-3 text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Master Role</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Manajemen hak akses pengguna</p>
                </div>
                <a href="{{ route('admin.roles.create') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Role
                </a>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">

            <table class="min-w-full text-xs sm:text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Menus</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($roles as $role)
                        @php
                            $isUsed = $role->users->count() > 0;
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>

                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $role->name }}
                                @if ($isUsed)
                                    <span class="ml-1 text-[10px] bg-red-100 text-red-700 px-2 py-0.5 rounded-full">
                                        Dipakai
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $role->slug }}
                            </td>

                            {{-- MENUS --}}
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($role->menus as $menu)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs
                                                 bg-blue-100 text-blue-800">
                                            {{ $menu->title }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-4 py-3 text-center whitespace-nowrap">

                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                {{-- DELETE --}}
                                @if ($isUsed)
                                    <button disabled
                                        class="inline-flex items-center px-3 py-1.5 bg-gray-300 text-gray-500 rounded-md text-xs ml-1 cursor-not-allowed"
                                        title="Role masih digunakan oleh user">
                                        <i class="fas fa-lock mr-1"></i> Delete
                                    </button>
                                @else
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        class="inline-block ml-1 delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="openDeleteModal(this)"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                Data role belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    {{-- ================= DELETE MODAL ================= --}}
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-sm mx-4 p-6 animate-scale">

            <div class="text-center">
                <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                </div>

                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Role?</h3>
                <p class="text-sm text-gray-600 mb-6">
                    Role ini akan dihapus permanen dan tidak bisa dikembalikan.
                </p>

                <div class="flex justify-center gap-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm">
                        Batal
                    </button>

                    <button id="confirmDeleteBtn"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                        Ya, Hapus
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        let currentDeleteForm = null;

        function openDeleteModal(button) {
            currentDeleteForm = button.closest('form');
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentDeleteForm = null;
        }

        document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
            if (currentDeleteForm) {
                currentDeleteForm.submit();
            }
        });

        // Toast auto close
        function closeToast() {
            const t = document.getElementById('toast-success');
            if (t) {
                t.classList.add('opacity-0');
                setTimeout(() => t.remove(), 300);
            }
        }
        setTimeout(closeToast, 4000);
    </script>

    {{-- ================= STYLE ================= --}}
    <style>
        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-scale {
            animation: scaleIn .15s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(30px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide {
            animation: slideIn .25s ease-out;
        }
    </style>
@endsection
