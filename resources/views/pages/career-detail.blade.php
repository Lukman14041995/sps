@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
<section class="relative bg-blue-900">
    <div class="relative h-[250px] sm:h-[300px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="Career Detail"
                loading="lazy">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative h-full flex items-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('frontend.career.index') }}" 
                           class="inline-flex items-center text-white hover:text-blue-200 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Lowongan
                        </a>
                    </div>

                    <!-- Job Title -->
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-3">
                        {{ $job->title }}
                    </h1>

                    <!-- Job Details -->
                    <div class="flex flex-wrap items-center gap-4 text-blue-100">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $job->department }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $job->location }}
                            @if($job->is_remote)
                            <span class="ml-2 px-2 py-1 bg-green-500/20 text-green-300 text-xs rounded">Remote</span>
                            @endif
                        </div>
                        @if($job->application_deadline)
                        <div class="flex items-center {{ now()->gt($job->application_deadline) ? 'text-red-300' : 'text-green-300' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Deadline: {{ $job->application_deadline->translatedFormat('d F Y') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job Detail Content -->
<section class="py-8 sm:py-12 md:py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8">
                        <!-- Urgent Badge -->
                        @if($job->is_urgent)
                        <div class="mb-6">
                            <span class="px-4 py-2 bg-red-100 text-red-700 text-sm font-bold rounded-lg">
                                ⚠️ LOWONGAN URGENT - SEGERA DIBUTUHKAN
                            </span>
                        </div>
                        @endif

                        <!-- Job Description -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                Deskripsi Pekerjaan
                            </h2>
                            <div class="prose max-w-none text-gray-700">
                                {!! $job->full_description !!}
                            </div>
                        </div>

                        <!-- Responsibilities -->
                        @if($job->responsibilities)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                Tanggung Jawab
                            </h2>
                            <div class="prose max-w-none text-gray-700">
                                {!! $job->responsibilities !!}
                            </div>
                        </div>
                        @endif

                        <!-- Requirements -->
                        @if($job->requirements)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                Persyaratan
                            </h2>
                            <div class="prose max-w-none text-gray-700">
                                {!! $job->requirements !!}
                            </div>
                        </div>
                        @endif

                        <!-- Application Instructions -->
                        <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Cara Melamar</h3>
                            <p class="text-gray-700 mb-4">Kirim lamaran Anda ke:</p>
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="font-medium">hr@spscorporate.com</span>
                            </div>
                            <p class="text-sm text-gray-600">Dengan subjek: "Lamaran - {{ $job->position }}"</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Job Overview -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                            Ringkasan Pekerjaan
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="text-sm text-gray-500">Tipe Pekerjaan</div>
                                <div class="font-medium text-gray-900">{{ $job->employment_type }}</div>
                            </div>
                            
                            <div>
                                <div class="text-sm text-gray-500">Lokasi</div>
                                <div class="font-medium text-gray-900">{{ $job->location }}</div>
                            </div>
                            
                            @if($job->experience_level)
                            <div>
                                <div class="text-sm text-gray-500">Level Pengalaman</div>
                                <div class="font-medium text-gray-900">{{ $job->experience_level }}</div>
                            </div>
                            @endif
                            
                            @if($job->salary_range)
                            <div>
                                <div class="text-sm text-gray-500">Gaji</div>
                                <div class="font-medium text-green-600">{{ $job->salary_range }}</div>
                            </div>
                            @endif
                            
                            <div>
                                <div class="text-sm text-gray-500">Diposting</div>
                                <div class="font-medium text-gray-900">{{ $job->created_at->translatedFormat('d F Y') }}</div>
                            </div>
                            
                            @if($job->application_deadline)
                            <div>
                                <div class="text-sm text-gray-500">Tenggat Waktu</div>
                                <div class="font-medium {{ now()->gt($job->application_deadline) ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $job->application_deadline->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Apply CTA -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-center">
                        <h3 class="text-lg font-bold text-white mb-4">Tertarik dengan posisi ini?</h3>
                        
                        <a href="mailto:hr@spscorporate.com?subject=Lamaran - {{ urlencode($job->title) }}&body=Dear HR Team,%0D%0A%0D%0ASaya tertarik dengan posisi {{ urlencode($job->title) }} di SPS Corporate.%0D%0ABerikut saya lampirkan CV dan dokumen pendukung lainnya.%0D%0A%0D%0AHormat saya,%0D%0A[Nama Lengkap]%0D%0A[No. Telepon]"
                           class="block w-full py-3 bg-white text-blue-600 font-bold rounded-lg hover:bg-gray-100 transition-colors mb-4">
                            Lamar Sekarang
                        </a>
                        
                        <a href="{{ route('frontend.contact') }}" 
                           class="block w-full py-3 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-colors">
                            Tanya HR
                        </a>
                    </div>

                    <!-- Share Job -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan Lowongan</h3>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                               target="_blank"
                               class="flex-1 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-center">
                                Facebook
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                               target="_blank"
                               class="flex-1 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors text-center">
                                LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Jobs -->
@if($relatedJobs->count() > 0)
<section class="py-8 sm:py-12 bg-white border-t border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Lowongan Serupa</h2>
            <div class="space-y-4">
                @foreach($relatedJobs as $relatedJob)
                <a href="{{ route('frontend.career.show', $relatedJob->id) }}" 
                   class="block bg-gray-50 hover:bg-blue-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $relatedJob->title }}</h3>
                            <div class="flex items-center gap-4 mt-1 text-sm text-gray-600">
                                <span>{{ $relatedJob->department }}</span>
                                <span>{{ $relatedJob->location }}</span>
                                <span>{{ $relatedJob->employment_type }}</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5em;
        margin-bottom: 1em;
    }
    
    .prose ol {
        list-style-type: decimal;
        padding-left: 1.5em;
        margin-bottom: 1em;
    }
    
    .prose li {
        margin-bottom: 0.5em;
    }
</style>
@endpush