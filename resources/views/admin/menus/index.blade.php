@extends('admin.layouts.app')

@section('title', 'Master Menu')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">Master Menu</h1>
                    <p class="text-gray-500 text-xs sm:text-sm">Manajemen struktur menu & submenu</p>
                </div>

                <div class="flex items-center gap-3">
                    <input type="text" id="searchMenu"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm w-full sm:w-56"
                        placeholder="Cari menu...">

                    <a href="{{ route('admin.menus.create') }}"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm transition whitespace-nowrap">
                        <i class="fas fa-plus mr-1"></i> Tambah Menu
                    </a>
                </div>
            </div>
        </div>

        {{-- ================= SUCCESS ALERT FROM SESSION ================= --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- ================= TABLE ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">

            <table class="min-w-full text-xs sm:text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wide">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Menu</th>
                        <th class="px-4 py-3">Route</th>
                        <th class="px-4 py-3">Icon</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Parent</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody id="menu-sortable" class="divide-y divide-gray-200">

                    @forelse($menus as $menu)
                        {{-- PARENT --}}
                        <tr data-id="{{ $menu->id }}" class="menu-row hover:bg-gray-50 transition cursor-move">
                            <td class="px-4 py-3 font-medium">{{ $loop->iteration }}</td>

                            <td class="px-4 py-3 font-medium text-gray-900">
                                <span class="inline-flex items-center gap-2">
                                    <i class="fas fa-grip-vertical text-gray-400"></i>
                                    <i class="{{ $menu->icon ?: 'fas fa-folder' }} text-blue-500"></i>
                                    {{ $menu->title }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-600">{{ $menu->route ?: '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $menu->icon ?: '-' }}</td>
                            <td class="px-4 py-3">{{ $menu->order }}</td>
                            <td class="px-4 py-3 text-gray-500">-</td>

                            <td class="px-4 py-3 text-center whitespace-nowrap">

                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600
                                      text-white rounded-md text-xs transition">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>

                                @if ($menu->children->count() > 0)
                                    <button disabled
                                        class="inline-flex items-center px-3 py-1.5 bg-gray-300 text-gray-600
                                           rounded-md text-xs cursor-not-allowed ml-1"
                                        title="Hapus submenu dulu">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                @else
                                    <button onclick="confirmDelete('{{ route('admin.menus.destroy', $menu->id) }}')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700
                                           text-white rounded-md text-xs transition ml-1">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                @endif

                            </td>
                        </tr>

                        {{-- CHILD --}}
                        @foreach ($menu->children as $child)
                            <tr class="menu-row bg-gray-50 hover:bg-gray-100 transition">
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 pl-10 text-gray-800">
                                    <span class="inline-flex items-center gap-2">
                                        <i class="fas fa-angle-right text-gray-400"></i>
                                        <i class="{{ $child->icon ?: 'far fa-circle' }} text-gray-500"></i>
                                        {{ $child->title }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-gray-600">{{ $child->route ?: '-' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $child->icon ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $child->order }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $menu->title }}</td>

                                <td class="px-4 py-3 text-center whitespace-nowrap">

                                    <a href="{{ route('admin.menus.edit', $child->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600
                                          text-white rounded-md text-xs transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>

                                    <button onclick="confirmDelete('{{ route('admin.menus.destroy', $child->id) }}')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700
                                           text-white rounded-md text-xs transition ml-1">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach

                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                Data menu belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

    {{-- ================= TOAST ================= --}}
    <div id="toast" class="hidden fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg z-50">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="toastMsg">Berhasil</span>
    </div>

    {{-- ================= DELETE MODAL ================= --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-sm">

            <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Menu</h3>
            <p class="text-sm text-gray-600 mb-5">
                Yakin ingin menghapus menu ini?
            </p>

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

    {{-- ================= SCRIPTS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        /* ================= DRAG DROP ================= */
        new Sortable(document.getElementById('menu-sortable'), {
            animation: 150,
            handle: '.fa-grip-vertical',
            draggable: 'tr[data-id]',
            onEnd: function() {

                let orders = [];
                document.querySelectorAll('#menu-sortable tr[data-id]').forEach(row => {
                    orders.push(row.dataset.id);
                });

                fetch("{{ route('admin.menus.reorder') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        orders
                    })
                }).then(() => {
                    showToast('Urutan menu berhasil disimpan');
                    setTimeout(() => location.reload(), 800);
                });
            }
        });

        /* ================= SEARCH ================= */
        document.getElementById('searchMenu').addEventListener('input', function() {
            const keyword = this.value.toLowerCase();

            document.querySelectorAll('.menu-row').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(keyword) ?
                    '' : 'none';
            });
        });

        /* ================= TOAST ================= */
        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.classList.remove('hidden');

            setTimeout(() => toast.classList.add('hidden'), 2500);
        }

        /* ================= DELETE MODAL ================= */
        function confirmDelete(action) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = action;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
