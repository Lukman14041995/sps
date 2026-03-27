@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-blue-900">
        <!-- Container dengan height yang terkontrol -->
        <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                    class="w-full h-full object-cover" alt="SPS Corporate Business Units" style="object-position: center 30%;"
                    loading="lazy">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
            </div>

            <!-- Content -->
            <div class="relative h-full flex items-center justify-center">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto">
                        <!-- Title -->
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                            Business <span class="text-blue-300">Portfolio</span>
                        </h1>

                        <!-- Divider -->
                        <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                        <!-- Description -->
                        <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                            Portofolio perusahaan SPS Corporate yang beroperasi di berbagai sektor industri strategis
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12 sm:mb-16">
                    <div class="inline-flex items-center justify-center mb-4">
                        <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                        <span class="mx-3 sm:mx-4 text-xs sm:text-sm font-semibold tracking-wider text-blue-600 uppercase">
                            Integrated Business Network
                        </span>
                        <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                        Portofolio <span class="text-blue-700">Perusahaan</span>
                    </h2>

                    <p class="text-gray-600 text-base sm:text-lg max-w-3xl mx-auto leading-relaxed">
                        SPS Corporate Group mengelola portofolio perusahaan yang beroperasi di berbagai sektor industri
                        strategis,
                        dari manufaktur kertas hingga properti, membentuk ekosistem bisnis yang terintegrasi dan
                        berkelanjutan.
                    </p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12 sm:mb-16">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-blue-700 mb-2">6</div>
                        <div class="text-sm text-gray-600">Business Units</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-blue-700 mb-2">20+</div>
                        <div class="text-sm text-gray-600">Perusahaan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-blue-700 mb-2">15+</div>
                        <div class="text-sm text-gray-600">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-blue-700 mb-2">5000+</div>
                        <div class="text-sm text-gray-600">Karyawan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Business Units Grid -->
    <section id="business" class="bg-gray-50 py-16">
        <div class="w-full">

            <!-- HEADER -->
            <div class="max-w-7xl mx-auto px-6 lg:px-10 mb-12 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    SPS Corporate <span class="text-blue-700">Subholding</span>
                </h2>

                <div class="mt-4 w-24 h-1 mx-auto bg-gradient-to-r from-blue-500 to-blue-700 rounded-full"></div>
            </div>

            @php
                $businesses = [
                    [
                        'name' => 'Tissue Paper Manufacturer',
                        'slug' => 'tissue-paper',
                        'logo' => asset('img/bussines/logo-tissue.png'),
                        'image' => asset('img/bussines/Tissue Paper.png'),
                        'gradient' => 'from-blue-900/80 via-blue-700/50 to-transparent',
                    ],
                    [
                        'name' => 'Paper Manufacturer',
                        'slug' => 'paper-manufacturer',
                        'logo' => asset('img/bussines/logo-paper.png'),
                        'image' => asset('img/bussines/Paper Manufacturer.jpg'),
                        'gradient' => 'from-indigo-900/80 via-indigo-700/50 to-transparent',
                    ],
                    [
                        'name' => 'Packaging Manufacturer',
                        'slug' => 'packaging',
                        'logo' => asset('img/bussines/logo-packaging.png'),
                        'image' => asset('img/bussines/packaging.jpg'),
                        'gradient' => 'from-emerald-900/80 via-emerald-700/50 to-transparent',
                    ],
                    [
                        'name' => 'Construction Materials',
                        'slug' => 'construction-materials',
                        'logo' => asset('img/bussines/logo-construction.png'),
                        'image' => asset('img/bussines/manufaktur.jpg'),
                        'gradient' => 'from-amber-900/80 via-amber-700/50 to-transparent',
                    ],
                    [
                        'name' => 'Property & Leisure',
                        'slug' => 'property-leisure',
                        'logo' => asset('img/bussines/logo-property.png'),
                        'image' => asset('img/bussines/property.jpg'),
                        'gradient' => 'from-purple-900/80 via-purple-700/50 to-transparent',
                    ],
                    [
                        'name' => 'Energy & Others',
                        'slug' => 'energy',
                        'logo' => asset('img/bussines/logo-energy.png'),
                        'image' => asset('img/bussines/other.jpg'),
                        'gradient' => 'from-cyan-900/80 via-cyan-700/50 to-transparent',
                    ],
                ];
            @endphp

            <!-- MASONRY GRID -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-2 px-2 lg:px-4">

                @foreach ($businesses as $b)
                    <a href="{{ url('/business/' . $b['slug']) }}"
                        class="group relative mb-2 block overflow-hidden bg-black break-inside-avoid">

                        <!-- IMAGE WRAPPER -->
                        <div class="relative overflow-hidden">

                            <!-- SKELETON -->
                            <div class="absolute inset-0 skeleton z-10"></div>

                            <!-- IMAGE (LQIP) -->
                            <img src="{{ $b['image'] }}" loading="lazy" decoding="async"
                                class="w-full object-cover scale-110 blur-lg
                               transition-all duration-700"
                                onload="
                            this.classList.remove('blur-lg');
                            this.previousElementSibling.remove();
                        ">

                            <!-- BASE DARK OVERLAY -->
                            <div class="absolute inset-0 bg-black/40"></div>

                            <!-- HOVER GRADIENT -->
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100
                                bg-gradient-to-t {{ $b['gradient'] }}
                                transition duration-300">
                            </div>

                            <!-- GLASS EFFECT -->
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100
                                backdrop-blur-md bg-white/10
                                transition duration-300">
                            </div>

                            <!-- LOGO -->
                            <div
                                class="absolute top-4 left-4 z-20
                                opacity-0 translate-y-2
                                group-hover:opacity-100 group-hover:translate-y-0
                                transition duration-300">
                                <div class="bg-white/90 backdrop-blur p-3 shadow-lg">
                                    <img src="{{ $b['logo'] }}" class="h-10 object-contain">
                                </div>
                            </div>

                            <!-- CTA CENTER -->
                            <div
                                class="absolute inset-0 flex items-center justify-center z-20
                                opacity-0 group-hover:opacity-100
                                transition duration-300">
                                <span
                                    class="px-6 py-3 text-sm font-semibold
                                   bg-white/90 backdrop-blur
                                   text-gray-900 shadow-lg
                                   transform scale-95 group-hover:scale-100
                                   transition">
                                    View Detail →
                                </span>
                            </div>

                            <!-- TITLE -->
                            <div class="absolute bottom-4 left-4 right-4 z-20">
                                <h3
                                    class="text-white text-base font-semibold inline-block relative
                                   after:block after:h-[2px] after:w-0
                                   after:bg-white after:mt-2
                                   after:transition-all after:duration-500
                                   group-hover:after:w-full">
                                    {{ $b['name'] }}
                                </h3>
                            </div>

                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Strategic Advantages -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                        Keunggulan <span class="text-blue-300">Strategis</span>
                    </h2>
                    <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-300 to-blue-400 rounded-full mx-auto mb-6">
                    </div>
                    <p class="text-blue-100 text-base sm:text-lg max-w-3xl mx-auto">
                        Keunggulan kompetitif yang dimiliki oleh ekosistem bisnis SPS Corporate
                    </p>
                </div>

                <!-- Advantages Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Advantage 1 -->
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Vertical Integration</h3>
                        <p class="text-blue-100 text-sm leading-relaxed">
                            Integrasi vertikal dari bahan baku hingga produk jadi meningkatkan efisiensi dan kualitas.
                        </p>
                    </div>

                    <!-- Advantage 2 -->
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Quality Assurance</h3>
                        <p class="text-blue-100 text-sm leading-relaxed">
                            Standar kualitas tertinggi di setiap proses produksi dengan sertifikasi internasional.
                        </p>
                    </div>

                    <!-- Advantage 3 -->
                    <div
                        class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Skala Ekonomi</h3>
                        <p class="text-blue-100 text-sm leading-relaxed">
                            Operasi berskala besar menghasilkan efisiensi biaya dan daya saing harga yang optimal.
                        </p>
                    </div>
                </div>

                <!-- Additional Stats -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">100+</div>
                        <div class="text-blue-100 text-sm">Produk Unggulan</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">ISO 9001</div>
                        <div class="text-blue-100 text-sm">Sertifikasi Mutu</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">30+</div>
                        <div class="text-blue-100 text-sm">Pasar Ekspor</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-2">Rp 5T+</div>
                        <div class="text-blue-100 text-sm">Aset Kelolaan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Manufacturing Excellence -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        Keunggulan <span class="text-blue-700">Manufaktur</span>
                    </h2>
                    <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6">
                    </div>
                    <p class="text-gray-600 text-base sm:text-lg max-w-3xl mx-auto">
                        Teknologi dan proses manufaktur mutakhir yang menjadi fondasi keberhasilan bisnis kami
                    </p>
                </div>

                <!-- Manufacturing Features -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Teknologi Modern</h3>
                        <p class="text-gray-600 text-sm">
                            Menggunakan mesin dan teknologi terbaru dari Eropa dan Jepang untuk kualitas produk terbaik
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Quality Control</h3>
                        <p class="text-gray-600 text-sm">
                            Sistem kontrol kualitas ketat di setiap tahap produksi untuk konsistensi produk
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Efisiensi Energi</h3>
                        <p class="text-gray-600 text-sm">
                            Sistem produksi hemat energi untuk operasi yang berkelanjutan dan ramah lingkungan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center text-white">
                <!-- Icon -->
                <div
                    class="w-16 h-16 sm:w-20 sm:h-20 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>

                <!-- Title -->
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 sm:mb-6">
                    Ingin Bekerja Sama?
                </h2>

                <!-- Description -->
                <p class="text-blue-100 text-base sm:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto leading-relaxed">
                    Jadilah bagian dari jaringan bisnis SPS Corporate sebagai mitra, supplier, atau distributor
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact"
                        class="group bg-white text-blue-700 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-sm sm:text-base hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Hubungi Partnership</span>
                    </a>
                    <a href="/products"
                        class="group bg-transparent border-2 border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-sm sm:text-base hover:bg-white/10 transition-all duration-300 inline-flex items-center justify-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <span>Lihat Produk Kami</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Card hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    /* Company list styling */
    .company-item {
        transition: all 0.2s ease;
    }

    .company-item:hover {
        transform: translateX(5px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .business-unit-card {
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            gap: 1rem;
        }
    }

    /* Image optimization */
    img {
        content-visibility: auto;
    }
</style>

@push('scripts')
    <script>
        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fadeInUp');
                    }
                });
            }, observerOptions);

            // Observe business unit cards
            document.querySelectorAll('.business-unit-card').forEach(card => {
                observer.observe(card);
            });

            // Observe advantage cards
            document.querySelectorAll('.advantage-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
@endpush
