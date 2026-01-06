@extends('admin.layouts.app')

@section('title', 'Buat Lowongan Kerja Baru')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Buat Lowongan Kerja Baru</h1>
            </div>
            <p class="text-gray-600">Tambah posisi baru untuk menerima lamaran</p>
        </div>
        <a href="{{ route('admin.career.index') }}"
            class="px-4 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    @if (session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <form action="{{ route('admin.career.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Informasi Dasar -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-4">
                            <!-- Posisi -->
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                                    Posisi *
                                </label>
                                <input type="text" id="position" name="position" value="{{ old('position') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('position') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Contoh: Senior Frontend Developer">
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Departemen -->
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-1">
                                    Departemen *
                                </label>
                                <select id="department" name="department"
                                    class="w-full px-4 py-3 border {{ $errors->has('department') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="">Pilih Departemen</option>
                                    <option value="Technology" {{ old('department') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Marketing" {{ old('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="Sales" {{ old('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>Human Resources</option>
                                    <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
                                </select>
                                @error('department')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Pekerjaan -->
                            <div>
                                <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Pekerjaan *
                                </label>
                                <select id="employment_type" name="employment_type"
                                    class="w-full px-4 py-3 border {{ $errors->has('employment_type') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="">Pilih Jenis</option>
                                    <option value="full_time" {{ old('employment_type') == 'full_time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part_time" {{ old('employment_type') == 'part_time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="remote" {{ old('employment_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                                @error('employment_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi & Gaji -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi & Gaji</h3>
                        <div class="space-y-4">
                            <!-- Lokasi -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                                    Lokasi *
                                </label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('location') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Contoh: Jakarta, Indonesia">
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gaji Minimal & Maksimal -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="salary_min" class="block text-sm font-medium text-gray-700 mb-1">
                                        Gaji Minimal
                                    </label>
                                    <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min') }}"
                                        class="w-full px-4 py-3 border {{ $errors->has('salary_min') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                        placeholder="Contoh: 10000000">
                                    @error('salary_min')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="salary_max" class="block text-sm font-medium text-gray-700 mb-1">
                                        Gaji Maksimal
                                    </label>
                                    <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max') }}"
                                        class="w-full px-4 py-3 border {{ $errors->has('salary_max') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                        placeholder="Contoh: 20000000">
                                    @error('salary_max')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail & Persyaratan -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Posisi</h3>
                        <div class="space-y-4">
                            <!-- Jumlah Lowongan -->
                            <div>
                                <label for="vacancies" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jumlah Lowongan *
                                </label>
                                <input type="number" id="vacancies" name="vacancies" value="{{ old('vacancies', 1) }}" min="1"
                                    class="w-full px-4 py-3 border {{ $errors->has('vacancies') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @error('vacancies')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pengalaman Diperlukan -->
                            <div>
                                <label for="experience_required" class="block text-sm font-medium text-gray-700 mb-1">
                                    Pengalaman Diperlukan (Tahun)
                                </label>
                                <input type="number" id="experience_required" name="experience_required" value="{{ old('experience_required') }}" min="0"
                                    class="w-full px-4 py-3 border {{ $errors->has('experience_required') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Contoh: 3">
                                @error('experience_required')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Batas Waktu Lamaran -->
                            <div>
                                <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-1">
                                    Batas Waktu Lamaran *
                                </label>
                                <input type="date" id="application_deadline" name="application_deadline" value="{{ old('application_deadline') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('application_deadline') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @error('application_deadline')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Aktif -->
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_active" class="text-sm text-gray-700">
                                    Aktif (Menerima lamaran)
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Pekerjaan -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Pekerjaan *</h3>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-3 border {{ $errors->has('description') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Jelaskan peran dan tanggung jawab...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Persyaratan -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Persyaratan *</h3>
                        <textarea id="requirements" name="requirements" rows="5"
                            class="w-full px-4 py-3 border {{ $errors->has('requirements') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Tuliskan persyaratan (satu per baris)...">{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Benefit -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Benefit (Opsional)</h3>
                        <textarea id="benefits" name="benefits" rows="3"
                            class="w-full px-4 py-3 border {{ $errors->has('benefits') ? 'border-red-300' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Tuliskan benefit (satu per baris)...">{{ old('benefits') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Masukkan setiap benefit pada baris baru</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.career.index') }}"
                    class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-xl font-semibold flex items-center gap-2 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl active:scale-95">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Lowongan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set tanggal minimum untuk batas waktu (besok)
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];
        
        const deadlineInput = document.getElementById('application_deadline');
        if (deadlineInput) {
            deadlineInput.min = tomorrowStr;
            if (!deadlineInput.value) {
                deadlineInput.value = tomorrowStr;
            }
        }
        
        // Validasi gaji
        const salaryMin = document.getElementById('salary_min');
        const salaryMax = document.getElementById('salary_max');
        
        function validateSalary() {
            if (salaryMin.value && salaryMax.value && 
                parseInt(salaryMin.value) > parseInt(salaryMax.value)) {
                alert('Gaji maksimal harus lebih besar dari gaji minimal');
                salaryMax.focus();
                return false;
            }
            return true;
        }
        
        salaryMax.addEventListener('blur', validateSalary);
        
        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!validateSalary()) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
@endsection