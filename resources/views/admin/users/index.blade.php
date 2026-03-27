@extends('admin.layouts.app')
@section('title', 'User Management')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4">

        {{-- Success Notification --}}
        <div id="delete-success-notification" class="fixed top-4 right-4 z-50 hidden">
            <div class="bg-green-50 border border-green-200 rounded-xl shadow-lg p-4 max-w-sm animate-slide-in-right">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-green-800">
                            User berhasil dihapus!
                        </p>
                        <p class="text-xs text-green-600 mt-1">
                            Data user telah dihapus dari sistem.
                        </p>
                    </div>
                    <button type="button" onclick="hideDeleteNotification()"
                        class="ml-4 -my-1.5 -mx-1.5 p-1.5 text-green-500 hover:text-green-600 rounded-lg hover:bg-green-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-[99vw] mx-auto">
            {{-- Header --}}
            <div class="mb-6 md:mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-white rounded-xl shadow-sm">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                                    User Management
                                </h1>
                                <p class="text-gray-600 mt-1 text-sm md:text-base">
                                    Kelola pengguna dan hak akses sistem
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="search" id="user-search" placeholder="Cari nama atau email..."
                                class="pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64 bg-white shadow-sm">
                        </div>

                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="fas fa-plus mr-2"></i>
                            <span class="hidden sm:inline">Tambah User</span>
                            <span class="inline sm:hidden">Tambah</span>
                        </a>
                    </div>
                </div>

                {{-- Stats Cards --}}
                {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Total Users</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-red-100 text-red-600">
                                <i class="fas fa-user-shield text-lg"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Admin</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $adminCount }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-green-100 text-green-600">
                                <i class="fas fa-user-tie text-lg"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">HR</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $hrCount }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-purple-100 text-purple-600">
                                <i class="fas fa-bullhorn text-lg"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Marketing</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $marketingCount }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            {{-- Main Content --}}
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden h-[calc(100vh-280px)] min-h-[500px] flex flex-col">
                {{-- Table Header --}}
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Daftar User
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Kelola semua pengguna sistem
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="relative">
                                <select id="role-filter"
                                    class="appearance-none bg-white border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-8">
                                    <option value="">Semua Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="hr">HR</option>
                                    <option value="marketing">Marketing</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== MOBILE CARD VIEW ===== --}}
                <div class="flex-1 overflow-y-auto sm:hidden">
                    <div class="divide-y divide-gray-200" id="mobile-user-list">
                        @forelse($users as $i => $user)
                            <div class="user-card p-4 hover:bg-gray-50 transition-colors duration-150 border-l-4 border-blue-500"
                                data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}"
                                data-roles="{{ $user->roles->pluck('name')->implode(',') }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-3">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-gray-900 truncate">{{ $user->name }}</h4>
                                                <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            @forelse($user->roles as $role)
                                                @php
                                                    $colors = [
                                                        'admin' => 'bg-red-100 text-red-800 border-red-200',
                                                        'hr' => 'bg-green-100 text-green-800 border-green-200',
                                                        'marketing' =>
                                                            'bg-purple-100 text-purple-800 border-purple-200',
                                                    ];
                                                    $color =
                                                        $colors[strtolower($role->name)] ??
                                                        'bg-gray-100 text-gray-800 border-gray-200';
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium border {{ $color }} mr-1 mb-1">
                                                    <i class="fas fa-user-tag mr-1.5 text-xs"></i>
                                                    {{ $role->name }}
                                                </span>
                                            @empty
                                                <span class="text-gray-400 text-sm">No role assigned</span>
                                            @endforelse
                                        </div>

                                        <div class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-calendar-alt mr-1.5"></i>
                                            ID: {{ $user->id }}
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-2 ml-3">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded-xl transition-all duration-200 shadow-sm hover:shadow-md active:scale-95"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            class="btn-delete inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl transition-all duration-200 shadow-sm hover:shadow-md active:scale-95"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center h-full flex items-center justify-center">
                                <div class="max-w-md mx-auto">
                                    <div
                                        class="mx-auto w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum ada user</h3>
                                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan user baru ke sistem</p>
                                    <a href="{{ route('admin.users.create') }}"
                                        class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
                                        <i class="fas fa-plus mr-2"></i> Tambah User Pertama
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- ===== DESKTOP TABLE VIEW ===== --}}
                <div class="flex-1 overflow-hidden hidden sm:flex flex-col">
                    <div class="overflow-x-auto flex-1">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        User
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="desktop-user-list">
                                @forelse($users as $i => $user)
                                    <tr class="user-row hover:bg-gray-50 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500"
                                        data-name="{{ strtolower($user->name) }}"
                                        data-email="{{ strtolower($user->email) }}"
                                        data-roles="{{ $user->roles->pluck('name')->implode(',') }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $i + 1 }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow mr-4">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900">{{ $user->name }}
                                                    </div>
                                                    {{-- <div class="text-xs text-gray-500 flex items-center mt-1">
                                                        <i class="fas fa-id-card mr-1.5"></i>
                                                        ID: {{ $user->id }}
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="fas fa-envelope text-gray-400 mr-2 text-sm"></i>
                                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-wrap gap-2">
                                                @forelse($user->roles as $role)
                                                    @php
                                                        $colors = [
                                                            'admin' => 'bg-red-100 text-red-800 border border-red-200',
                                                            'hr' =>
                                                                'bg-green-100 text-green-800 border border-green-200',
                                                            'marketing' =>
                                                                'bg-purple-100 text-purple-800 border border-purple-200',
                                                        ];
                                                        $color =
                                                            $colors[strtolower($role->name)] ??
                                                            'bg-gray-100 text-gray-800 border border-gray-200';
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium {{ $color }}">
                                                        <i class="fas fa-user-tag mr-1.5 text-xs"></i>
                                                        {{ $role->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded-xl text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md active:scale-95 group">
                                                    <i
                                                        class="fas fa-edit mr-2 group-hover:rotate-12 transition-transform"></i>
                                                    Edit
                                                </a>

                                                <button type="button" data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }}"
                                                    class="btn-delete inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md active:scale-95 group">
                                                    <i class="fas fa-trash mr-2 group-hover:shake"></i> Hapus
                                                </button>

                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12">
                                            <div class="max-w-md mx-auto text-center">
                                                <div
                                                    class="mx-auto w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                                                </div>
                                                <h3 class="text-xl font-semibold text-gray-900 mb-3">Belum ada user</h3>
                                                <p class="text-gray-500">Mulai dengan menambahkan user baru</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if ($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> sampai
                                <span class="font-medium">{{ $users->lastItem() }}</span> dari
                                <span class="font-medium">{{ $users->total() }}</span> user
                            </div>
                            <div class="flex space-x-2">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= MODAL CONFIRM DELETE ================= --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all w-full max-w-md animate-modal-in">
                    <div class="bg-white p-6">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 mb-4">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-2" id="modal-title">
                                Hapus User
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">
                                    Anda akan menghapus user:
                                </p>
                                <p class="text-lg font-semibold text-gray-900 mt-2" id="delete-user-name">
                                    <!-- Nama user akan dimasukkan via JS -->
                                </p>
                                <p class="text-sm text-red-600 mt-4">
                                    <i class="fas fa-exclamation-circle mr-1.5"></i>
                                    Tindakan ini tidak dapat dibatalkan!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-5 flex flex-col sm:flex-row-reverse gap-3">
                        <button id="confirmDelete" type="button"
                            class="inline-flex w-full justify-center items-center rounded-xl bg-gradient-to-r from-red-600 to-red-700 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:from-red-700 hover:to-red-800 transition-all duration-200 active:scale-95">
                            <i class="fas fa-trash mr-2"></i> Ya, Hapus Sekarang
                        </button>
                        <button id="cancelDelete" type="button"
                            class="inline-flex w-full justify-center items-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors active:scale-95">
                            <i class="fas fa-times mr-2"></i> Batalkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const modal = document.getElementById('deleteModal');
            const cancelBtn = document.getElementById('cancelDelete');
            const confirmBtn = document.getElementById('confirmDelete');
            const deleteUserName = document.getElementById('delete-user-name');
            const userSearch = document.getElementById('user-search');
            const roleFilter = document.getElementById('role-filter');
            const userCount = document.getElementById('user-count');

            let currentForm = null;
            let currentUserName = '';

            // ===== DELETE MODAL LOGIC =====
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    currentUserName = this.dataset.name;
                    currentForm = document.getElementById('delete-form-' + id);

                    // Set user name in modal
                    deleteUserName.textContent = currentUserName;

                    // Show modal with animation
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('flex');
                    }, 10);
                });
            });

            cancelBtn.addEventListener('click', () => {
                closeModal();
            });

            confirmBtn.addEventListener('click', () => {
                if (currentForm) {
                    // Submit form
                    currentForm.submit();

                    // Show success notification
                    showDeleteSuccessNotification();

                    // Close modal
                    closeModal();
                }
            });

            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal || e.target.classList.contains('bg-black/60')) {
                    closeModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            function closeModal() {
                modal.classList.remove('flex');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    currentForm = null;
                    currentUserName = '';
                }, 200);
            }

            // ===== SEARCH FUNCTIONALITY =====
            if (userSearch) {
                userSearch.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    filterUsers(searchTerm, roleFilter.value);
                });
            }

            // ===== ROLE FILTER FUNCTIONALITY =====
            if (roleFilter) {
                roleFilter.addEventListener('change', function(e) {
                    filterUsers(userSearch.value, e.target.value);
                });
            }

            // ===== FILTER USERS FUNCTION =====
            function filterUsers(searchTerm, selectedRole) {
                let visibleCount = 0;
                const allUsers = document.querySelectorAll('.user-card, .user-row');

                allUsers.forEach(userElement => {
                    const name = userElement.dataset.name || '';
                    const email = userElement.dataset.email || '';
                    const roles = userElement.dataset.roles || '';

                    // Check search term
                    const matchesSearch = !searchTerm ||
                        name.includes(searchTerm) ||
                        email.includes(searchTerm);

                    // Check role filter
                    const matchesRole = !selectedRole ||
                        roles.toLowerCase().includes(selectedRole.toLowerCase());

                    // Show/hide based on filters
                    if (matchesSearch && matchesRole) {
                        userElement.style.display = '';
                        visibleCount++;

                        // Add animation
                        userElement.style.animation = 'none';
                        setTimeout(() => {
                            userElement.style.animation = 'fadeIn 0.3s ease';
                        }, 10);
                    } else {
                        userElement.style.display = 'none';
                    }
                });

                // Update counter
                if (userCount) {
                    userCount.textContent = visibleCount;
                }

                // Show no results message
                showNoResultsMessage(visibleCount === 0 && (searchTerm || selectedRole));
            }

            function showNoResultsMessage(show) {
                // Remove existing no results message
                const existingMessage = document.querySelector('.no-results-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                if (show) {
                    const searchTerm = userSearch.value;
                    const selectedRole = roleFilter.value;

                    let message = 'Tidak ditemukan user';
                    if (searchTerm && selectedRole) {
                        message =
                            `Tidak ditemukan user dengan nama/email "${searchTerm}" dan role "${selectedRole}"`;
                    } else if (searchTerm) {
                        message = `Tidak ditemukan user dengan nama/email "${searchTerm}"`;
                    } else if (selectedRole) {
                        message = `Tidak ditemukan user dengan role "${selectedRole}"`;
                    }

                    const messageElement = document.createElement('div');
                    messageElement.className = 'no-results-message p-8 text-center col-span-full';
                    messageElement.innerHTML = `
                    <div class="mx-auto w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">${message}</h3>
                    <p class="text-gray-500">Coba kata kunci atau filter yang berbeda</p>
                `;

                    // Insert message in appropriate place
                    const mobileList = document.getElementById('mobile-user-list');
                    const desktopList = document.getElementById('desktop-user-list');

                    if (mobileList && mobileList.children.length === 0) {
                        mobileList.appendChild(messageElement);
                    }
                    if (desktopList) {
                        const tbody = desktopList.querySelector('tbody') || desktopList;
                        if (tbody.children.length === 0) {
                            tbody.appendChild(messageElement);
                        }
                    }
                }
            }

            // ===== DELETE SUCCESS NOTIFICATION =====
            function showDeleteSuccessNotification() {
                const notification = document.getElementById('delete-success-notification');

                // Reset animation
                notification.classList.remove('animate-slide-in-right', 'animate-slide-out-right');

                // Show notification
                notification.classList.remove('hidden');
                notification.classList.add('flex');
                notification.classList.add('animate-slide-in-right');

                // Auto hide after 5 seconds
                setTimeout(() => {
                    hideDeleteNotification();
                }, 5000);
            }

            // Initialize animation for existing rows
            setTimeout(() => {
                const rows = document.querySelectorAll('.user-card, .user-row');
                rows.forEach((row, index) => {
                    row.style.opacity = '0';
                    row.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        row.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            }, 100);

            // Initial filter on page load
            filterUsers('', '');
        });

        // ===== NOTIFICATION FUNCTIONS =====
        function hideDeleteNotification() {
            const notification = document.getElementById('delete-success-notification');
            notification.classList.remove('animate-slide-in-right');
            notification.classList.add('animate-slide-out-right');

            setTimeout(() => {
                notification.classList.add('hidden');
                notification.classList.remove('flex', 'animate-slide-out-right');
            }, 300);
        }

        // Check for success message from session
        @if (session('success'))
            setTimeout(() => {
                const notification = document.getElementById('delete-success-notification');
                notification.querySelector('.text-green-800').textContent = "{{ session('success') }}";
                notification.querySelector('.text-green-600').textContent = "Operasi berhasil dilakukan";
                notification.classList.remove('hidden');
                notification.classList.add('flex');
                notification.classList.add('animate-slide-in-right');

                setTimeout(() => {
                    hideDeleteNotification();
                }, 5000);
            }, 500);
        @endif
    </script>

    <style>
        /* Animations */
        @keyframes slide-in-right {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-out-right {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes modal-in {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: rotate(0);
            }

            25% {
                transform: rotate(-5deg);
            }

            75% {
                transform: rotate(5deg);
            }
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.3s ease-out;
        }

        .animate-slide-out-right {
            animation: slide-out-right 0.3s ease-in forwards;
        }

        .animate-modal-in {
            animation: modal-in 0.2s ease-out;
        }

        .group-hover\:shake:hover i {
            animation: shake 0.5s ease;
        }

        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        /* Full height table */
        .h-\[calc\(100vh-280px\)\] {
            height: calc(100vh - 280px);
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .h-\[calc\(100vh-280px\)\] {
                height: calc(100vh - 220px);
            }

            .max-w-\[99vw\] {
                max-width: 99vw;
            }
        }
    </style>
@endsection
