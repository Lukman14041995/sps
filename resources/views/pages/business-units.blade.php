@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section class="relative bg-blue-900">
    <!-- Container dengan height yang terkontrol -->
    <div class="relative h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] xl:h-[500px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="SPS Corporate Business Units"
                style="object-position: center 30%;"
                loading="lazy">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
        </div>

        <!-- Content -->
        <div class="relative h-full flex items-center justify-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">
                    <!-- Breadcrumb -->
                    <!-- <nav class="mb-4 sm:mb-6 hidden sm:block">
                        <ol class="flex items-center justify-center space-x-2 text-white/80 text-sm">
                            <li>
                                <a href="/" class="hover:text-white transition-colors duration-300">Home</a>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium text-white">Business Units</span>
                            </li>
                        </ol>
                    </nav> -->

                    <!-- Badge -->
                    <!-- <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-white font-medium tracking-wider">PORTFOLIO COMPANIES</span>
                    </div> -->

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
                    SPS Corporate Group mengelola portofolio perusahaan yang beroperasi di berbagai sektor industri strategis,
                    dari manufaktur kertas hingga properti, membentuk ekosistem bisnis yang terintegrasi dan berkelanjutan.
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
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Unit Bisnis <span class="text-blue-700">Kami</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Enam pilar utama yang membentuk ekosistem bisnis SPS Corporate Group
                </p>
            </div>

            <!-- Business Units Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $businessUnits = [
                [
                'title' => 'Tissue Paper Manufacturer',
                'icon' => '📄',
                'description' => 'Produsen tisu berkualitas tinggi untuk kebutuhan rumah tangga, komersial, dan industri.',
                'image' => 'https://images.unsplash.com/photo-1581362713576-3d7a43c97a5d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Sinar Paper Sukses',
                'PT Tissue Prima Indonesia',
                'PT Hygienic Tissue Manufacturing',
                'PT Clean Paper Industries'
                ],
                'color' => 'blue'
                ],
                [
                'title' => 'Paper Manufacturer',
                'icon' => '📜',
                'description' => 'Produsen berbagai jenis kertas untuk kebutuhan cetak, kemasan, dan industri.',
                'image' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Pulp & Paper Indonesia',
                'PT Kertas Nusantara Jaya',
                'PT Paper Manufacturing Solutions',
                'PT Pulpindo Maju Bersama'
                ],
                'color' => 'green'
                ],
                [
                'title' => 'Packaging Manufacturer',
                'icon' => '📦',
                'description' => 'Produsen kemasan inovatif untuk berbagai industri makanan, minuman, dan consumer goods.',
                'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Packaging Innovasi Indonesia',
                'PT Box Pack Manufacturing',
                'PT Kemasan Modern Nusantara',
                'PT Packaging Solutions International'
                ],
                'color' => 'purple'
                ],
                [
                'title' => 'Construction Materials Manufacturer',
                'icon' => '🏗️',
                'description' => 'Produsen bahan bangunan berkualitas untuk mendukung industri konstruksi nasional.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Bangunan Material Indonesia',
                'PT Semen Nusantara Tbk',
                'PT Baja Konstruksi Indonesia',
                'PT Material Bangunan Sukses'
                ],
                'color' => 'orange'
                ],
                [
                'title' => 'Property & Leisure',
                'icon' => '🏨',
                'description' => 'Pengembang properti dan operator fasilitas leisure untuk lifestyle modern.',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Property Development Indonesia',
                'PT Leisure & Hospitality Group',
                'PT Real Estate Nusantara',
                'PT Hotel Management International'
                ],
                'color' => 'red'
                ],
                [
                'title' => 'Others',
                'icon' => '🔧',
                'description' => 'Investasi strategis di sektor-sektor industri pendukung dan emerging markets.',
                'image' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'companies' => [
                'PT Energy Solutions Indonesia',
                'PT Logistic & Distribution Nusantara',
                'PT Digital Technology Solutions',
                'PT Agro Business Indonesia'
                ],
                'color' => 'teal'
                ]
                ];

                $colorClasses = [
                'blue' => [
                'bg' => 'bg-blue-100',
                'text' => 'text-blue-800',
                'hover' => 'hover:bg-blue-200'
                ],
                'green' => [
                'bg' => 'bg-green-100',
                'text' => 'text-green-800',
                'hover' => 'hover:bg-green-200'
                ],
                'purple' => [
                'bg' => 'bg-purple-100',
                'text' => 'text-purple-800',
                'hover' => 'hover:bg-purple-200'
                ],
                'orange' => [
                'bg' => 'bg-orange-100',
                'text' => 'text-orange-800',
                'hover' => 'hover:bg-orange-200'
                ],
                'red' => [
                'bg' => 'bg-red-100',
                'text' => 'text-red-800',
                'hover' => 'hover:bg-red-200'
                ],
                'teal' => [
                'bg' => 'bg-teal-100',
                'text' => 'text-teal-800',
                'hover' => 'hover:bg-teal-200'
                ]
                ];
                @endphp

                @foreach($businessUnits as $unit)
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <!-- Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $unit['image'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            alt="{{ $unit['title'] }}"
                            loading="lazy">
                        <!-- Icon Badge -->
                        <div class="absolute top-4 left-4 w-12 h-12 {{ $colorClasses[$unit['color']]['bg'] }} rounded-xl flex items-center justify-center">
                            <span class="text-2xl">{{ $unit['icon'] }}</span>
                        </div>
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors">
                            {{ $unit['title'] }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                            {{ $unit['description'] }}
                        </p>

                        <!-- Companies -->
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Perusahaan di Grup:
                            </h4>
                            <div class="space-y-2">
                                @foreach($unit['companies'] as $company)
                                <div class="flex items-center text-sm">
                                    <svg class="w-3 h-3 {{ $colorClasses[$unit['color']]['text'] }} mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ $company }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Learn More -->
                        <a href="#"
                            class="inline-flex items-center {{ $colorClasses[$unit['color']]['text'] }} font-medium text-sm group/link">
                            <span>Lihat Detail Perusahaan</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
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
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-300 to-blue-400 rounded-full mx-auto mb-6"></div>
                <p class="text-blue-100 text-base sm:text-lg max-w-3xl mx-auto">
                    Keunggulan kompetitif yang dimiliki oleh ekosistem bisnis SPS Corporate
                </p>
            </div>

            <!-- Advantages Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Advantage 1 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Vertical Integration</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        Integrasi vertikal dari bahan baku hingga produk jadi meningkatkan efisiensi dan kualitas.
                    </p>
                </div>

                <!-- Advantage 2 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Quality Assurance</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        Standar kualitas tertinggi di setiap proses produksi dengan sertifikasi internasional.
                    </p>
                </div>

                <!-- Advantage 3 -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center group hover:bg-white/15 transition-all duration-300">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
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
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Hubungi Partnership</span>
                </a>
                <a href="/products"
                    class="group bg-transparent border-2 border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-sm sm:text-base hover:bg-white/10 transition-all duration-300 inline-flex items-center justify-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
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