@extends('layouts.frontend')

@section('content')

<!-- Hero Section Responsif -->
<section class="relative bg-blue-900">
    <!-- Container dengan height yang terkontrol -->
    <div class="relative h-[300px] sm:h-[350px] md:h-[400px] lg:h-[500px] xl:h-[550px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="SPS Corporate Headquarters"
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
                                <span class="font-medium text-white">About Us</span>
                            </li>
                        </ol>
                    </nav> -->

                    <!-- Badge -->
                    <!-- <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-white font-medium tracking-wider text-sm">CORPORATE PROFILE</span>
                    </div> -->

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                        SPS <span class="text-blue-300">Corporate</span>
                        <span class="block mt-2 sm:mt-3">Since 1973</span>
                    </h1>

                    <!-- Divider -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <!-- Description -->
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                        Welcome to SPS Corporate, an Indonesian holding company dedicated to meeting the needs of our customers through constant innovation and improvement.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Overview Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div>
                    <div class="mb-8 sm:mb-10 lg:mb-12">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-semibold tracking-wider">COMPANY OVERVIEW</span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                            Tentang <span class="text-blue-700">SPS Corporate</span>
                        </h2>

                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mb-6 sm:mb-8"></div>
                    </div>

                    <div class="space-y-4 sm:space-y-6">
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            SPS Corporate merupakan perusahaan holding yang bergerak di berbagai bidang usaha
                            dengan fokus pada solusi profesional, inovatif, dan berorientasi pada kepuasan pelanggan.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Dengan pengalaman lebih dari 50 tahun dan sumber daya yang kompeten, kami berkomitmen untuk
                            terus tumbuh dan memberikan kontribusi positif bagi mitra bisnis serta masyarakat luas.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Kami mengelola portofolio bisnis yang beragam, masing-masing dengan keunggulan di sektornya,
                            namun bersatu dalam visi bersama untuk keunggulan dan keberlanjutan.
                        </p>
                    </div>

                    <!-- Key Points -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mt-8 sm:mt-10">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Profesionalisme</h4>
                                <p class="text-gray-600 text-xs sm:text-sm mt-1">Standar tinggi dalam setiap layanan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Inovasi</h4>
                                <p class="text-gray-600 text-xs sm:text-sm mt-1">Solusi terkini untuk tantangan bisnis</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="relative">
                    <div class="relative rounded-xl sm:rounded-2xl lg:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl group">
                        <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            class="w-full h-64 sm:h-72 md:h-80 lg:h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"
                            alt="SPS Corporate Team"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <!-- Floating Stats Card -->
                        <div class="absolute -bottom-4 sm:-bottom-6 -right-4 sm:-right-6 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg sm:shadow-xl w-48 sm:w-56 lg:w-64">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-700 mb-1 sm:mb-2">1973</div>
                                <div class="text-xs sm:text-sm text-gray-600 font-semibold">Tahun Berdiri</div>
                                <div class="w-12 sm:w-16 h-1 bg-gradient-to-r from-blue-500 to-blue-700 mx-auto mt-2 sm:mt-3 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div class="absolute -top-4 -left-4 sm:-top-6 sm:-left-6 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-gradient-to-r from-blue-100 to-blue-200 rounded-xl sm:rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                <span class="mx-3 sm:mx-4 text-xs sm:text-sm font-semibold tracking-wider text-blue-600 uppercase">
                    Our Foundation
                </span>
                <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
            </div>

            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                Visi & <span class="text-blue-700">Misi</span>
            </h2>

            <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                Fondasi yang membimbing setiap keputusan dan tindakan kami dalam membangun bisnis berkelanjutan
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 sm:gap-10 lg:gap-12 max-w-6xl mx-auto">
            <!-- Vision Card -->
            <div class="group relative">
                <div class="absolute -inset-0.5 sm:-inset-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl sm:rounded-3xl blur opacity-20 sm:opacity-25 group-hover:opacity-40 sm:group-hover:opacity-50 transition duration-500 sm:duration-1000"></div>
                <div class="relative bg-white p-6 sm:p-8 lg:p-10 xl:p-12 rounded-2xl sm:rounded-3xl shadow-lg sm:shadow-xl hover:shadow-xl sm:hover:shadow-2xl transition-all duration-300 sm:duration-500">
                    <div class="flex items-start mb-6 sm:mb-8 lg:mb-10">
                        <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mr-4 sm:mr-6">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-2 sm:mb-4">Our Vision</h3>
                            <div class="w-8 sm:w-10 lg:w-12 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4 sm:mb-6"></div>
                        </div>
                    </div>

                    <blockquote class="text-lg sm:text-xl text-gray-700 leading-relaxed italic border-l-4 border-blue-500 pl-4 sm:pl-6 py-3 sm:py-4 mb-6 sm:mb-8 lg:mb-10">
                        "To build a global corporation that continuously grows through God's favor, leaves legacy,
                        and becomes a channel of blessing for stakeholders."
                    </blockquote>

                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <p class="text-gray-600 text-base">
                            We envision sustainable growth that creates value not only for shareholders but also for employees, partners, and the communities we serve.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission Card -->
            <div class="group relative">
                <div class="absolute -inset-0.5 sm:-inset-1 bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl sm:rounded-3xl blur opacity-20 sm:opacity-25 group-hover:opacity-40 sm:group-hover:opacity-50 transition duration-500 sm:duration-1000"></div>
                <div class="relative bg-white p-6 sm:p-8 lg:p-10 xl:p-12 rounded-2xl sm:rounded-3xl shadow-lg sm:shadow-xl hover:shadow-xl sm:hover:shadow-2xl transition-all duration-300 sm:duration-500">
                    <div class="flex items-start mb-6 sm:mb-8 lg:mb-10">
                        <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mr-4 sm:mr-6">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3l2 2m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-2 sm:mb-4">Our Mission</h3>
                            <div class="w-8 sm:w-10 lg:w-12 h-1 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full mb-4 sm:mb-6"></div>
                        </div>
                    </div>

                    <div class="space-y-6 sm:space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-purple-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                                    <span class="text-purple-700 font-bold text-sm sm:text-base lg:text-lg">1</span>
                                </div>
                            </div>
                            <div class="ml-3 sm:ml-4 lg:ml-6">
                                <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Human Capital Excellence</h4>
                                <p class="text-gray-700 leading-relaxed text-sm sm:text-base">
                                    Develop competency by placing the right person in the right position at the right time, fostering a results-driven culture through continuous training and development.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-purple-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                                    <span class="text-purple-700 font-bold text-sm sm:text-base lg:text-lg">2</span>
                                </div>
                            </div>
                            <div class="ml-3 sm:ml-4 lg:ml-6">
                                <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Innovation & Excellence</h4>
                                <p class="text-gray-700 leading-relaxed text-sm sm:text-base">
                                    Pursue excellence through innovation by adopting cutting-edge technology and efficient production management to deliver consistent quality and value-added products.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-purple-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                                    <span class="text-purple-700 font-bold text-sm sm:text-base lg:text-lg">3</span>
                                </div>
                            </div>
                            <div class="ml-3 sm:ml-4 lg:ml-6">
                                <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Strategic Partnerships</h4>
                                <p class="text-gray-700 leading-relaxed text-sm sm:text-base">
                                    Build long-term, fruitful partnerships with all stakeholders to ensure mutual growth and sustainable success across our business ecosystem.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Responsive improvements */
    @media (max-width: 640px) {

        /* Mobile-specific adjustments */
        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .p-6 {
            padding: 1.5rem;
        }
    }

    @media (max-width: 768px) {

        /* Tablet-specific adjustments */
        .lg\:grid-cols-2 {
            grid-template-columns: 1fr;
        }

        .gap-12 {
            gap: 2rem;
        }
    }

    /* Image optimization */
    img {
        max-width: 100%;
        height: auto;
        display: block;
    }
</style>