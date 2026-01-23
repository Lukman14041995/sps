@extends('admin.layouts.app')

@section('title', 'Master Business Unit')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= TOAST ================= --}}
        @if (session('success'))
            <div id="toast-success"
                class="fixed top-5 right-5 z-50 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="toast-error"
                class="fixed top-5 right-5 z-50 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow">
                <i class="fas fa-times-circle mr-1"></i> {{ session('error') }}
            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Master Business Unit</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Manajemen unit bisnis perusahaan</p>
                </div>

                <a href="{{ route('admin.bisnis-unit.create') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Unit
                </a>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">

            <table class="min-w-full text-xs sm:text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Logo</th>
                        <th class="px-4 py-3">Nama Unit</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($data as $i => $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>

                            {{-- Logo --}}
                            <td class="px-4 py-3">
                                @if ($row->logo)
                                    <img src="{{ Storage::disk('s3')->url($row->logo) }}"
                                        class="h-10 w-10 object-cover rounded bg-gray-200">
                                @else
                                    <span class="text-gray-400 text-xs italic">No Image</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $row->nama_unit }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $row->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $row->telepon ?? '-' }}
                            </td>

                            {{-- ACTION --}}
                            <td class="px-4 py-3 text-center whitespace-nowrap">

                                <a href="{{ route('admin.bisnis-unit.edit', $row->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                <button onclick="openDeleteModal('{{ route('admin.bisnis-unit.destroy', $row->id) }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition ml-1">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                Data Business Unit belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= DELETE MODAL ================= --}}
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-sm shadow-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Data</h3>
            <p class="text-sm text-gray-600 mb-5">Yakin ingin menghapus data ini?</p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm">
                        Batal
                    </button>

                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        function openDeleteModal(action) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = action;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // auto hide toast
        setTimeout(() => {
            document.getElementById('toast-success')?.remove();
            document.getElementById('toast-error')?.remove();
        }, 3500);
    </script>
@endsection
