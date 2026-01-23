@extends('admin.layouts.app')

@section('title', 'Input Role')

@section('content')
    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900">
                        Input Role Baru
                    </h1>
                    <p class="text-gray-500 text-xs sm:text-sm">
                        Tambahkan role dan tentukan akses menu
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
            <form action="{{ route('admin.roles.store') }}" method="POST" id="roleForm" class="space-y-4 sm:space-y-8">
                @csrf

                {{-- BASIC INFO --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-3">
                        Informasi Role
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6">

                        {{-- NAME --}}
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                Nama Role
                            </label>
                            <input type="text" name="name" id="roleName" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm"
                                placeholder="Contoh: Admin">
                        </div>

                        {{-- SLUG --}}
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                Slug
                            </label>
                            <input type="text" name="slug" id="roleSlug" value="{{ old('slug') }}" required
                                class="w-full px-3 py-2 rounded-lg border border-gray-300
                               focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm"
                                placeholder="contoh: admin">

                            <p id="slugStatus" class="text-xs mt-1 hidden"></p>
                        </div>

                    </div>
                </div>

                {{-- MENU ACCESS --}}
                <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-6 shadow-sm">

                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-900">
                            Menu Akses
                        </h3>

                        <div class="flex items-center gap-3">
                            <span id="selected-menu-count" class="text-xs sm:text-sm font-medium text-gray-500">
                                0 dipilih
                            </span>

                            <label class="flex items-center gap-2 text-xs sm:text-sm cursor-pointer">
                                <input type="checkbox" id="selectAllMenus"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 font-medium">Pilih Semua</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-3">
                        @foreach ($menus as $menu)
                            <label
                                class="flex items-center p-2 sm:p-3 rounded-lg border cursor-pointer transition
                                   border-gray-200 hover:border-blue-300 hover:bg-blue-50">

                                <input type="checkbox" name="menus[]" value="{{ $menu->id }}"
                                    class="h-4 w-4 sm:h-5 sm:w-5 rounded border-gray-300 text-blue-600
                                   focus:ring-blue-500 mr-2 sm:mr-3 menu-checkbox">

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

                        <button type="submit" id="submitBtn"
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700
                               text-white rounded-lg shadow transition text-sm font-medium">
                            <i class="fas fa-save mr-2"></i> Simpan Role
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* ================= AUTO SLUG ================= */
            const nameInput = document.getElementById('roleName');
            const slugInput = document.getElementById('roleSlug');
            const slugStatus = document.getElementById('slugStatus');
            const submitBtn = document.getElementById('submitBtn');

            let slugManuallyEdited = false;
            let slugIsValid = true;
            let debounceTimer;

            slugInput.addEventListener('input', () => {
                slugManuallyEdited = true;
                checkSlug(slugInput.value);
            });

            nameInput.addEventListener('input', () => {
                if (slugManuallyEdited) return;

                const slug = nameInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                slugInput.value = slug;
                checkSlug(slug);
            });

            function checkSlug(slug) {
                clearTimeout(debounceTimer);

                if (!slug) {
                    setSlugStatus('', false);
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetch("{{ route('admin.roles.check-slug') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                slug: slug
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.exists) {
                                setSlugStatus('Slug sudah digunakan ❌', false);
                            } else {
                                setSlugStatus('Slug tersedia ✔', true);
                            }
                        });
                }, 400);
            }

            function setSlugStatus(message, valid) {
                if (!message) {
                    slugStatus.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                    return;
                }

                slugStatus.classList.remove('hidden');
                slugStatus.textContent = message;

                if (valid) {
                    slugStatus.className = 'text-xs mt-1 text-green-600';
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                } else {
                    slugStatus.className = 'text-xs mt-1 text-red-600';
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
                }
            }

            /* ================= SELECT ALL MENU ================= */
            const selectAll = document.getElementById('selectAllMenus');
            const checkboxes = document.querySelectorAll('.menu-checkbox');

            updateSelectedMenus();

            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateSelectedMenus();
            });

            checkboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    const total = checkboxes.length;
                    const checked = document.querySelectorAll('.menu-checkbox:checked').length;
                    selectAll.checked = total === checked;
                    updateSelectedMenus();
                });
            });

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
