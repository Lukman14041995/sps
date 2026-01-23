@extends('admin.layouts.app')

@section('title', 'Tambah Business Unit')

@section('content')
    {{-- TOAST --}}
    <div id="toast" class="fixed top-5 right-5 z-50 hidden items-center gap-2 px-4 py-3 rounded-lg shadow transition">
        <i id="toastIcon" class="fas"></i>
        <span id="toastMessage">Message</span>
    </div>

    <div class="w-full bg-gray-50 px-2 sm:px-6 lg:px-8 py-4 sm:py-8">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-4 px-3 sm:px-6 py-4">
            <div>
                <h1 class="text-lg sm:text-xl font-bold text-gray-900">Tambah Business Unit</h1>
                <p class="text-gray-500 text-xs sm:text-sm">Lengkapi data unit bisnis dengan benar</p>
            </div>
        </div>

        {{-- ================= ERROR ================= --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- ================= FORM ================= --}}
        <form action="{{ route('admin.bisnis-unit.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 sm:p-6 space-y-5">
            @csrf

            {{-- Kategori Bisnis --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kategori Bisnis</label>
                <select name="bisnis_kategori_id" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('bisnis_kategori_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Bisnis Unit --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Bisnis Unit</label>
                <input type="text" name="nama_unit" value="{{ old('nama_unit') }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat') }}</textarea>
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Telepon --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- PIC --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Penanggung Jawab (PIC)</label>
                <input type="text" name="pic" value="{{ old('pic') }}"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- LOGO + PREVIEW --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Logo Bisnis Unit</label>

                <div class="flex items-center gap-4">
                    <img id="logoPreview" src="https://via.placeholder.com/100x100?text=Preview"
                        class="w-24 h-24 object-cover rounded-lg border bg-gray-100">

                    <div class="flex-1">
                        <input type="file" name="logo" accept="image/*" onchange="previewLogo(event)"
                            class="w-full text-sm text-gray-600
                               file:bg-gray-100 file:border file:border-gray-300
                               file:px-4 file:py-2 file:rounded-lg file:cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1">Max 2MB (jpg, png, webp)</p>
                    </div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-3 justify-between">
                <a href="{{ route('admin.bisnis-unit.index') }}"
                    class="px-5 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm text-center">
                    ← Kembali
                </a>

                <button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                    Simpan
                </button>
            </div>

        </form>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        function showToast(message, type = 'error') {
            const toast = document.getElementById('toast');
            const msg = document.getElementById('toastMessage');
            const icon = document.getElementById('toastIcon');

            msg.textContent = message;

            // reset class
            toast.className = 'fixed top-5 right-5 z-50 flex items-center gap-2 px-4 py-3 rounded-lg shadow transition';

            if (type === 'success') {
                toast.classList.add('bg-green-100', 'border', 'border-green-300', 'text-green-800');
                icon.className = 'fas fa-check-circle';
            } else {
                toast.classList.add('bg-red-100', 'border', 'border-red-300', 'text-red-800');
                icon.className = 'fas fa-exclamation-circle';
            }

            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        function previewLogo(event) {
            const input = event.target;
            const preview = document.getElementById('logoPreview');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!file.type.startsWith('image/')) {
                    showToast('File harus berupa gambar!', 'error');
                    input.value = '';
                    preview.src = 'https://via.placeholder.com/100x100?text=Preview';
                    return;
                }

                if (file.size > maxSize) {
                    showToast('Ukuran gambar maksimal 2MB!', 'error');
                    input.value = '';
                    preview.src = 'https://via.placeholder.com/100x100?text=Preview';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    showToast('Preview logo berhasil dimuat', 'success');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
