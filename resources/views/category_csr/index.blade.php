@extends('admin.layouts.app')

@section('title', 'Master Category CSR')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= TOAST SUCCESS ================= --}}
        @if (session('success'))
            <div id="toast-success" class="fixed top-4 right-4 z-50">
                <div class="bg-white border border-green-200 rounded-xl shadow-lg p-4 max-w-sm animate-slide-in">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-900">{{ session('success') }}</p>
                            <p class="text-sm text-gray-500">Berhasil diproses</p>
                        </div>
                        <button onclick="closeToast()" class="ml-auto text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Master Category CSR</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Manajemen kategori CSR</p>
                </div>
                <a href="{{ route('admin.category-csr.create') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Kategori
                </a>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">

            <table class="min-w-full text-xs sm:text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @forelse($data as $i => $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>

                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $row->nama_kategori }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $row->keterangan ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center whitespace-nowrap">

                                <a href="{{ route('admin.category-csr.edit', $row->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <button onclick="openDeleteModal({{ $row->id }}, '{{ $row->nama_kategori }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition ml-1">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>

                                <form id="delete-form-{{ $row->id }}"
                                    action="{{ route('admin.category-csr.destroy', $row->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Data kategori belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= DELETE MODAL ================= --}}
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 mx-4">

            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Data</h3>
            <p class="text-sm text-gray-600 mb-6">
                Yakin ingin menghapus kategori
                <span id="deleteName" class="font-semibold text-red-600"></span> ?
            </p>

            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm">
                    Batal
                </button>

                <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                    Ya, Hapus
                </button>
            </div>

        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        let deleteId = null;

        function openDeleteModal(id, name) {
            deleteId = id;
            document.getElementById('deleteName').innerText = name;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal() {
            deleteId = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        });

        function closeToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => toast.remove(), 300);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                setTimeout(closeToast, 4000);
            }
        });
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
