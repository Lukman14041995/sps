@extends('layouts.frontend')

@section('content')

<!-- Hero Section Responsif -->
<section class="relative bg-blue-900">
    <!-- Container dengan height yang terkontrol -->
    <div class="relative h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] xl:h-[500px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="SPS Corporate CSR"
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
                                <span class="font-medium text-white">CSR</span>
                            </li>
                        </ol>
                    </nav> -->

                    <!-- Badge -->
                    <!-- <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14.158v3.775c0 .642-.448 1.167-1 1.167h-3.5v-3.775c0-.642.448-1.167 1-1.167h3.5c.552 0 1 .525 1 1.167zm-7 0v3.775c0 .642-.448 1.167-1 1.167h-3.5v-3.775c0-.642.448-1.167 1-1.167h3.5c.552 0 1 .525 1 1.167zm-7 0v3.775c0 .642-.448 1.167-1 1.167h-3.5v-3.775c0-.642.448-1.167 1-1.167h3.5c.552 0 1 .525 1 1.167z" />
                        </svg>
                        <span class="text-white font-medium tracking-wider text-sm">SOCIAL RESPONSIBILITY</span>
                    </div> -->

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                        Corporate Social
                        <span class="block text-blue-300 mt-2 sm:mt-3">Responsibility</span>
                    </h1>

                    <!-- Divider -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <!-- Description -->
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                        Komitmen SPS Corporate dalam memberikan dampak positif bagi masyarakat dan lingkungan
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About CSR Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div>
                    <div class="mb-8 sm:mb-10 lg:mb-12">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="text-sm font-semibold tracking-wider">OUR COMMITMENT</span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                            Komitmen <span class="text-blue-700">Sosial</span>
                        </h2>

                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mb-6 sm:mb-8"></div>
                    </div>

                    <div class="space-y-4 sm:space-y-6">
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            SPS Corporate menjalankan program Corporate Social Responsibility (CSR) sebagai wujud
                            tanggung jawab perusahaan terhadap masyarakat, lingkungan, dan pembangunan berkelanjutan.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Kami percaya bahwa kesuksesan bisnis harus sejalan dengan kontribusi positif bagi masyarakat
                            dan lingkungan sekitar tempat kami beroperasi.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Program CSR kami dirancang untuk memberikan manfaat jangka panjang, dengan melibatkan
                            berbagai pihak dan berfokus pada solusi nyata yang berkelanjutan.
                        </p>
                    </div>

                    <!-- CSR Impact Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 mt-8 sm:mt-10">
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">50+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Program CSR</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">1000+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Penerima Manfaat</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">3</div>
                            <div class="text-xs sm:text-sm text-gray-600">Fokus Area</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">15+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Tahun</div>
                        </div>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="relative">
                    <div class="relative rounded-xl sm:rounded-2xl lg:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl group">
                        <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            class="w-full h-64 sm:h-72 md:h-80 lg:h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"
                            alt="SPS Corporate CSR Activity"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <!-- Impact Card -->
                        <div class="absolute -bottom-4 sm:-bottom-6 -left-4 sm:-left-6 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg sm:shadow-xl w-48 sm:w-56 lg:w-64">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-green-600 mb-1 sm:mb-2">15+</div>
                                <div class="text-xs sm:text-sm text-gray-600 font-semibold">Tahun Berkomitmen</div>
                                <div class="w-12 sm:w-16 h-1 bg-gradient-to-r from-green-500 to-green-700 mx-auto mt-2 sm:mt-3 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-gradient-to-r from-green-100 to-green-200 rounded-xl sm:rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSR Focus Areas -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                    <span class="mx-3 sm:mx-4 text-xs sm:text-sm font-semibold tracking-wider text-blue-600 uppercase">
                        Our Focus Areas
                    </span>
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    Fokus <span class="text-blue-700">Program CSR</span>
                </h2>

                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                    Tiga pilar utama yang menjadi fokus program CSR SPS Corporate
                </p>
            </div>

            <!-- Focus Areas Grid -->
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Education -->
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <!-- Icon -->
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                            <span class="text-3xl">🎓</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-blue-700 transition-colors">
                            Pendidikan
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                            Mendukung peningkatan kualitas pendidikan melalui pelatihan,
                            beasiswa, dan fasilitas belajar yang memadai.
                        </p>

                        <!-- Programs List -->
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Program Beasiswa</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Renovasi Sekolah</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Pelatihan Guru</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Health -->
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <!-- Icon -->
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                            <span class="text-3xl">🏥</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-green-700 transition-colors">
                            Kesehatan
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                            Program kesehatan masyarakat untuk meningkatkan kualitas hidup
                            dan kesejahteraan masyarakat sekitar.
                        </p>

                        <!-- Programs List -->
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Klinik Gratis</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Program Sanitasi</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Donor Darah</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Environment -->
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <!-- Icon -->
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                            <span class="text-3xl">🌱</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-emerald-700 transition-colors">
                            Lingkungan
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                            Kepedulian terhadap kelestarian lingkungan melalui program
                            penghijauan dan pengelolaan sumber daya berkelanjutan.
                        </p>

                        <!-- Programs List -->
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Penghijauan</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Daur Ulang</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-700">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Konservasi Air</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSR Activities -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Kegiatan <span class="text-blue-700">CSR</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Program dan aktivitas CSR yang telah kami laksanakan
                </p>
            </div>

            <!-- Activities Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                $activities = [
                [
                'title' => 'Program Beasiswa Pendidikan',
                'description' => 'Memberikan bantuan pendidikan kepada siswa berprestasi dari keluarga kurang mampu',
                'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Pendidikan',
                'date' => '15 Oct 2025' // Ganti "Okt" menjadi "Oct"
                ],
                [
                'title' => 'Kampanye Penghijauan Lingkungan',
                'description' => 'Gerakan penanaman pohon untuk menjaga kelestarian lingkungan',
                'image' => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Lingkungan',
                'date' => '10 Sep 2025' // Ganti "Sep" menjadi "Sep" (sudah sama)
                ],
                [
                'title' => 'Pelayanan Kesehatan Gratis',
                'description' => 'Klinik keliling dan pemeriksaan kesehatan untuk masyarakat',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Kesehatan',
                'date' => '5 Aug 2025' // Ganti "Agu" menjadi "Aug"
                ],
                [
                'title' => 'Renovasi Fasilitas Sekolah',
                'description' => 'Perbaikan dan pembangunan fasilitas pendidikan',
                'image' => 'https://images.unsplash.com/photo-1524178234883-043d5c3f3cf4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Pendidikan',
                'date' => '20 Jul 2025' // Ganti "Jul" menjadi "Jul" (sudah sama)
                ],
                [
                'title' => 'Program Sanitasi Bersih',
                'description' => 'Penyediaan fasilitas sanitasi dan air bersih',
                'image' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Kesehatan',
                'date' => '15 Jun 2025' // Ganti "Jun" menjadi "Jun" (sudah sama)
                ],
                [
                'title' => 'Workshop Daur Ulang',
                'description' => 'Edukasi pengelolaan sampah dan daur ulang',
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'category' => 'Lingkungan',
                'date' => '5 May 2025' // Ganti "Mei" menjadi "May"
                ]
                ];
                @endphp

                @foreach($activities as $activity)
                <article class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <!-- Image -->
                    <div class="relative overflow-hidden">
                        <img src="{{ $activity['image'] }}"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-700"
                            alt="{{ $activity['title'] }}"
                            loading="lazy">
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            @php
                            $categoryColors = [
                            'Pendidikan' => 'bg-blue-600/90',
                            'Kesehatan' => 'bg-green-600/90',
                            'Lingkungan' => 'bg-emerald-600/90'
                            ];
                            @endphp
                            <span class="px-3 py-1 {{ $categoryColors[$activity['category']] ?? 'bg-blue-600/90' }} text-white text-xs font-semibold rounded-full">
                                {{ $activity['category'] }}
                            </span>
                        </div>
                        <!-- Date Badge -->
                        <div class="absolute bottom-4 right-4">
                            <div class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                                <div class="text-xs font-bold text-gray-900">{{ \Carbon\Carbon::parse($activity['date'])->format('d') }}</div>
                                <div class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($activity['date'])->format('M') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors">
                            {{ $activity['title'] }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            {{ $activity['description'] }}
                        </p>

                        <!-- Read More -->
                        <a href="#"
                            class="inline-flex items-center text-blue-600 font-medium text-sm group/link">
                            <span>Lihat Detail Kegiatan</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-10 sm:mt-12 lg:mt-16">
                <a href="#"
                    class="group inline-flex items-center px-6 sm:px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                    <span>Lihat Semua Kegiatan CSR</span>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CSR Impact Section -->
{{-- <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-r from-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl sm:rounded-2xl p-6 sm:p-8 lg:p-12 shadow-lg text-center">
                <!-- Icon -->
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Title -->
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4">
                    Dampak Positif yang Berkelanjutan
                </h3>

                <!-- Description -->
                <p class="text-gray-600 mb-6 sm:mb-8 max-w-2xl mx-auto text-sm sm:text-base">
                    Komitmen kami untuk terus memberikan dampak positif bagi masyarakat dan lingkungan melalui
                    program CSR yang terukur dan berkelanjutan
                </p>

                <!-- Get Involved Button -->
                <a href="/contact"
                    class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-emerald-800 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Ikut Berkontribusi</span>
                </a>
            </div>
        </div>
    </div>
</section> --}}

@endsection

<style>
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Card hover effects */
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }

    /* Responsive improvements */
    @media (max-width: 640px) {
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }
    }

    /* Image optimization */
    img {
        max-width: 100%;
        height: auto;
        display: block;
    }
</style>