@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section class="relative bg-blue-900">
    <!-- Container dengan height yang terkontrol -->
    <div class="relative h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] xl:h-[500px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="SPS Corporate Career"
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
                                <span class="font-medium text-white">Career</span>
                            </li>
                        </ol>
                    </nav> -->

                    <!-- Badge -->
                    <!-- <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-white font-medium tracking-wider">JOIN OUR TEAM</span>
                    </div> -->

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                        Grow Your Career
                        <span class="block text-blue-300 mt-2 sm:mt-3">With SPS Corporate</span>
                    </h1>

                    <!-- Divider -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <!-- Description -->
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                        Bergabunglah dengan tim inovatif kami dan kembangkan potensi terbaik Anda dalam lingkungan yang dinamis dan suportif
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Join Section -->
<section id="why-join" class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                    <span class="mx-3 sm:mx-4 text-xs sm:text-sm font-semibold tracking-wider text-blue-600 uppercase">
                        Why Choose Us
                    </span>
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    Mengapa Bergabung dengan <span class="text-blue-700">SPS Corporate?</span>
                </h2>

                <p class="text-gray-600 text-base sm:text-lg max-w-3xl mx-auto leading-relaxed">
                    Kami membangun lingkungan kerja yang mendukung pertumbuhan profesional dan personal
                </p>
            </div>

            <!-- Benefits Grid -->
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Benefit 1 -->
                <div class="group bg-white rounded-xl p-6 sm:p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <span class="text-3xl">🚀</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-blue-700 transition-colors">
                        Growth Opportunities
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                        Program pengembangan karir terstruktur, pelatihan berkala, dan kesempatan promosi yang jelas
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Career Path yang Jelas</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Pelatihan Berkelanjutan</span>
                        </li>
                    </ul>
                </div>

                <!-- Benefit 2 -->
                <div class="group bg-white rounded-xl p-6 sm:p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <span class="text-3xl">💼</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-green-700 transition-colors">
                        Competitive Package
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                        Kompensasi yang kompetitif dan manfaat komprehensif untuk kesejahteraan karyawan
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Gaji Kompetitif</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Asuransi Kesehatan</span>
                        </li>
                    </ul>
                </div>

                <!-- Benefit 3 -->
                <div class="group bg-white rounded-xl p-6 sm:p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <span class="text-3xl">🤝</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-purple-700 transition-colors">
                        Great Culture
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                        Lingkungan kerja kolaboratif yang mendukung inovasi dan work-life balance
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Work-Life Balance</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Budaya Kolaboratif</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Openings -->
<section id="vacancies" class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Lowongan <span class="text-blue-700">Tersedia</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Temukan posisi yang sesuai dengan keahlian dan minat Anda
                </p>
            </div>

            <!-- Job Categories -->
            <div class="flex flex-wrap justify-center gap-4 mb-8 sm:mb-12">
                <button class="px-6 py-3 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition-colors text-sm sm:text-base">
                    All Positions
                </button>
                <button class="px-6 py-3 bg-white text-blue-600 rounded-full font-medium hover:bg-blue-50 transition-colors border border-blue-600 text-sm sm:text-base">
                    Technology
                </button>
                <button class="px-6 py-3 bg-white text-blue-600 rounded-full font-medium hover:bg-blue-50 transition-colors border border-blue-600 text-sm sm:text-base">
                    Business
                </button>
                <button class="px-6 py-3 bg-white text-blue-600 rounded-full font-medium hover:bg-blue-50 transition-colors border border-blue-600 text-sm sm:text-base">
                    Marketing
                </button>
            </div>

            <!-- Job Listings -->
            <div class="space-y-6">
                <!-- Job Data - Hardcoded for now -->
                @php
                $jobListings = [
                [
                'title' => 'Senior Frontend Developer',
                'department' => 'Technology',
                'location' => 'Jakarta',
                'type' => 'Full-time',
                'experience' => '3+ years',
                'description' => 'Membangun dan mengoptimalkan aplikasi web menggunakan React.js dan Vue.js',
                'urgent' => true,
                'posted_date' => '2025-01-15'
                ],
                [
                'title' => 'Business Analyst',
                'department' => 'Business',
                'location' => 'Surabaya',
                'type' => 'Full-time',
                'experience' => '2+ years',
                'description' => 'Analisis kebutuhan bisnis dan memberikan solusi teknologi yang tepat',
                'urgent' => false,
                'posted_date' => '2025-01-10'
                ],
                [
                'title' => 'Digital Marketing Specialist',
                'department' => 'Marketing',
                'location' => 'Jakarta',
                'type' => 'Full-time',
                'experience' => '2+ years',
                'description' => 'Mengembangkan dan menjalankan strategi pemasaran digital',
                'urgent' => true,
                'posted_date' => '2025-01-05'
                ],
                [
                'title' => 'IT Support Engineer',
                'department' => 'Technology',
                'location' => 'Bandung',
                'type' => 'Contract',
                'experience' => '1+ years',
                'description' => 'Menyediakan dukungan teknis dan pemeliharaan sistem IT',
                'urgent' => false,
                'posted_date' => '2025-01-02'
                ],
                [
                'title' => 'Project Manager',
                'department' => 'Business',
                'location' => 'Jakarta',
                'type' => 'Full-time',
                'experience' => '5+ years',
                'description' => 'Memimpin dan mengelola proyek teknologi dari awal hingga selesai',
                'urgent' => true,
                'posted_date' => '2024-12-28'
                ],
                [
                'title' => 'UI/UX Designer',
                'department' => 'Design',
                'location' => 'Remote',
                'type' => 'Full-time',
                'experience' => '2+ years',
                'description' => 'Mendesain pengalaman pengguna yang intuitif dan menarik',
                'urgent' => false,
                'posted_date' => '2024-12-20'
                ]
                ];
                @endphp

                @foreach($jobListings as $index => $job)
                <div class="group bg-white rounded-xl p-6 sm:p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 border border-gray-200 hover:border-blue-300">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                        <!-- Job Info -->
                        <div class="mb-4 lg:mb-0 lg:mr-6 flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors">
                                    {{ $job['title'] }}
                                </h3>
                                @if($job['urgent'])
                                <span class="ml-3 px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                                    URGENT
                                </span>
                                @endif
                            </div>

                            <p class="text-gray-600 text-sm sm:text-base mb-4 leading-relaxed">
                                {{ $job['description'] }}
                            </p>

                            <!-- Job Details -->
                            <div class="flex flex-wrap gap-3 sm:gap-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span class="truncate">{{ $job['department'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate">{{ $job['location'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="truncate">{{ $job['type'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="truncate">{{ $job['experience'] }} experience</span>
                                </div>
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <div class="flex-shrink-0">
                            <a href="#"
                                class="group/btn inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                                <span>Apply Now</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Application Process -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Proses <span class="text-blue-700">Rekrutmen</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Langkah-langkah yang akan Anda lalui dalam proses rekrutmen kami
                </p>
            </div>

            <!-- Process Steps -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6">
                            <span class="text-2xl sm:text-3xl">📄</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">1. Apply</h3>
                        <p class="text-sm text-gray-600">
                            Kirim lamaran dan CV Anda
                        </p>
                    </div>
                    <div class="hidden lg:block absolute top-10 left-3/4 w-full h-0.5 bg-gray-300 -z-0"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6">
                            <span class="text-2xl sm:text-3xl">📞</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">2. Screening</h3>
                        <p class="text-sm text-gray-600">
                            Wawancara telepon awal
                        </p>
                    </div>
                    <div class="hidden lg:block absolute top-10 left-3/4 w-full h-0.5 bg-gray-300 -z-0"></div>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="relative z-10">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6">
                            <span class="text-2xl sm:text-3xl">💼</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">3. Interview</h3>
                        <p class="text-sm text-gray-600">
                            Wawancara dengan tim
                        </p>
                    </div>
                    <div class="hidden lg:block absolute top-10 left-3/4 w-full h-0.5 bg-gray-300 -z-0"></div>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <span class="text-2xl sm:text-3xl">✅</span>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">4. Offer</h3>
                    <p class="text-sm text-gray-600">
                        Penawaran kerja dan onboarding
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<!-- > -->

@endsection

<style>
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .process-step::after {
            content: none;
        }
    }

    /* Job card responsive adjustments */
    @media (max-width: 1024px) {
        .job-details {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
    }
</style>