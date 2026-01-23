@extends('layouts.frontend')

@section('content')

    {{-- ================= HERO DETAIL CSR ================= --}}
    <section class="relative bg-blue-900">
        <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">

            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="{{ Storage::disk('s3')->url($csr->featured_image) }}" class="w-full h-full object-cover"
                    alt="{{ $csr->title }}" style="object-position:center 30%;" loading="lazy">

                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
            </div>

            <!-- Content -->
            <div class="relative h-full flex items-end">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-10">
                    <div class="max-w-4xl text-white">

                        <!-- BREADCRUMB -->
                        <nav class="mb-4">
                            <ol class="flex flex-wrap items-center text-white/80 text-sm gap-1">
                                <li>
                                    <a href="{{ route('frontend.home') }}" class="hover:text-white transition">
                                        Home
                                    </a>
                                </li>
                                <li class="mx-1">/</li>
                                <li>
                                    <a href="{{ route('frontend.csr.index') }}" class="hover:text-white transition">
                                        CSR
                                    </a>
                                </li>
                                <li class="mx-1">/</li>
                                <li class="font-semibold text-white line-clamp-1">
                                    {{ $csr->title }}
                                </li>
                            </ol>
                        </nav>

                        <!-- TITLE -->
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl
                               font-bold leading-tight mb-3">
                            {{ $csr->title }}
                        </h1>

                        <!-- META -->
                        <div class="flex flex-wrap items-center gap-4 text-white/85 text-sm">

                            <!-- DATE -->
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($csr->created_at)->translatedFormat('d F Y') }}
                            </span>

                            <!-- LOCATION -->
                            @if ($csr->location)
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $csr->location }}
                                </span>
                            @endif

                            <!-- CATEGORY -->
                            <span class="px-3 py-1 bg-white/20 backdrop-blur rounded-full text-xs font-semibold">
                                {{ $categories[$csr->category]['name'] ?? $csr->category }}
                            </span>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- CSR Detail Content -->
    <section class="py-12 sm:py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Featured Image -->
                        <div class="rounded-xl overflow-hidden mb-8">
                            <img src="{{ Storage::disk('s3')->url($csr->featured_image) }}"
                                class="w-full h-auto max-h-[400px] object-cover" alt="{{ $csr->title }}" loading="lazy">
                        </div>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! $csr->content !!}
                        </div>

                        <!-- Gallery if exists -->
                        @if ($csr->gallery && count($csr->gallery) > 0)
                            <div class="mt-12">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Galeri Kegiatan</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                    @foreach ($csr->gallery as $image)
                                        <a href="{{ Storage::disk('s3')->url($image) }}" data-fancybox="gallery"
                                            class="block rounded-lg overflow-hidden group">
                                            <img src="{{ Storage::disk('s3')->url($image) }}"
                                                class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300"
                                                alt="Gallery Image {{ $loop->iteration }}" loading="lazy">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Program Stats -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Program</h3>
                            <div class="space-y-4">
                                @if ($csr->budget)
                                    <div>
                                        <p class="text-sm text-gray-600">Anggaran Program</p>
                                        <p class="text-xl font-bold text-blue-700">{{ $csr->formatted_budget }}</p>
                                    </div>
                                @endif

                                @if ($csr->beneficiaries_count)
                                    <div>
                                        <p class="text-sm text-gray-600">Penerima Manfaat</p>
                                        <p class="text-xl font-bold text-green-700">{{ $csr->formatted_beneficiaries }}</p>
                                    </div>
                                @endif

                                @if ($csr->duration)
                                    <div>
                                        <p class="text-sm text-gray-600">Durasi Program</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $csr->duration }}</p>
                                    </div>
                                @endif

                                @if ($csr->year)
                                    <div>
                                        <p class="text-sm text-gray-600">Tahun Pelaksanaan</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $csr->year }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Program Details -->
                        <div class="bg-blue-50 rounded-xl p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Detail Program</h3>
                            <div class="space-y-3">
                                @if ($csr->location)
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                            <p class="text-sm text-gray-600">{{ $csr->location }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Kategori</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $categories[$csr->category]['name'] ?? $csr->category }}</p>
                                    </div>
                                </div>

                                @if ($csr->project_lead)
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Penanggung Jawab</p>
                                            <p class="text-sm text-gray-600">{{ $csr->project_lead }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Related Programs -->
                        @if ($relatedCsr->count() > 0)
                            <div class="bg-white border border-gray-200 rounded-xl p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Program Terkait</h3>
                                <div class="space-y-4">
                                    @foreach ($relatedCsr as $related)
                                        <a href="{{ route('frontend.csr.show', $related->slug) }}" class="group block">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ Storage::disk('s3')->url($related->featured_image) }}"
                                                        class="w-12 h-12 object-cover rounded-lg"
                                                        alt="{{ $related->title }}" loading="lazy">
                                                </div>
                                                <div>
                                                    <h4
                                                        class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                                        {{ Str::limit($related->title, 50) }}</h4>
                                                    <p class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($related->created_at)->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Back to CSR -->
                        <a href="{{ route('frontend.csr.index') }}"
                            class="block w-full py-3 bg-blue-600 text-white text-center font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            ← Kembali ke Program CSR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <style>
        .prose {
            color: #374151;
        }

        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.7;
        }

        .prose img {
            border-radius: 0.5rem;
            margin: 2rem 0;
        }

        .prose h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }

        .prose h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #111827;
        }
    </style>
@endpush

@push('scripts')
    <!-- Fancybox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize fancybox for gallery
            $('[data-fancybox="gallery"]').fancybox({
                buttons: [
                    "slideShow",
                    "thumbs",
                    "zoom",
                    "fullScreen",
                    "close"
                ],
                loop: true
            });
        });
    </script>
@endpush
