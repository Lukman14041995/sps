@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section class="relative bg-blue-900">
    <!-- Container dengan height yang terkontrol -->
    <div class="relative h-[300px] sm:h-[350px] md:h-[400px] lg:h-[450px] xl:h-[500px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="Contact SPS Corporate"
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
                                <span class="font-medium text-white">Contact</span>
                            </li>
                        </ol>
                    </nav> -->

                    <!-- Badge -->
                    <!-- <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                        <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-white font-medium tracking-wider">GET IN TOUCH</span>
                    </div> -->

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                        Hubungi <span class="text-blue-300">Kami</span>
                    </h1>

                    <!-- Divider -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <!-- Description -->
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                        Hubungi SPS Corporate untuk informasi, kerja sama, atau pertanyaan lebih lanjut
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <div class="mb-8 sm:mb-10 lg:mb-12">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            <span class="text-blue-700">Informasi</span> Kontak
                        </h2>
                        <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mb-6"></div>
                        <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                            Tim kami siap membantu Anda dengan segala kebutuhan dan pertanyaan
                        </p>
                    </div>

                    <!-- Contact Details -->
                    <div class="space-y-6 sm:space-y-8">
                        <!-- Address -->
                        <div class="group flex items-start">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Alamat Kantor</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Jl. Contoh Alamat No. 123<br>
                                    Jakarta Selatan, 12345<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="group flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:bg-green-200 transition-colors">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Telepon</h3>
                                <p class="text-gray-600 mb-2">(021) 1234 5678</p>
                                <p class="text-sm text-gray-500">Senin – Jumat, 08.00 – 17.00 WIB</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="group flex items-start">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0 group-hover:bg-purple-200 transition-colors">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600 mb-2">info@spscorporate.co.id</p>
                                <p class="text-gray-600">sales@spscorporate.co.id</p>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="pt-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Ikuti Kami</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors group">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors group">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors group">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors group">
                                    <svg class="w-5 h-5 text-blue-600 group-hover:text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.445 17.827c-3.684 1.684-9.401-9.43-5.8-11.308l1.053-.519 1.746 3.409-1.042.513c-1.095.587 1.185 5.04 2.305 4.497l1.032-.505 1.76 3.397-1.054.516z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-6 sm:p-8">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">
                            Kirim <span class="text-blue-700">Pesan</span>
                        </h2>
                        <p class="text-gray-600 mb-8">
                            Isi form di bawah ini dan kami akan menghubungi Anda secepatnya
                        </p>

                        <form method="POST" action="#" class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="name"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                    name="email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="nama@email.com">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="tel"
                                    name="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="0812 3456 7890">
                            </div>

                            <!-- Subject -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Subjek <span class="text-red-500">*</span>
                                </label>
                                <select name="subject"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="" selected disabled>Pilih subjek</option>
                                    <option value="general">Informasi Umum</option>
                                    <option value="sales">Penawaran & Sales</option>
                                    <option value="support">Customer Support</option>
                                    <option value="career">Karir & Lowongan</option>
                                    <option value="partnership">Kerja Sama</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pesan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="message"
                                    required
                                    rows="6"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                    placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit"
                                    class="group w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        Kirim Pesan
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-8 p-6 bg-blue-50 rounded-xl">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Response Time</h3>
                                <p class="text-sm text-gray-600">
                                    Kami akan membalas pesan Anda dalam waktu 1-2 hari kerja. Untuk masalah yang lebih mendesak, silakan hubungi nomor telepon kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Departments Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Hubungi <span class="text-blue-700">Departemen</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Hubungi departemen terkait untuk kebutuhan yang lebih spesifik
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Sales -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Sales & Marketing</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Untuk penawaran produk, harga, dan informasi penjualan
                    </p>
                    <div class="text-sm">
                        <p class="text-gray-700 mb-1">sales@spscorporate.co.id</p>
                        <p class="text-gray-700">(021) 2345 6789</p>
                    </div>
                </div>

                <!-- Support -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Customer Support</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Bantuan teknis dan dukungan untuk pelanggan
                    </p>
                    <div class="text-sm">
                        <p class="text-gray-700 mb-1">support@spscorporate.co.id</p>
                        <p class="text-gray-700">(021) 3456 7890</p>
                    </div>
                </div>

                <!-- Career -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Karir & Rekrutmen</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Untuk informasi lowongan kerja dan pengiriman CV
                    </p>
                    <div class="text-sm">
                        <p class="text-gray-700 mb-1">career@spscorporate.co.id</p>
                        <p class="text-gray-700">(021) 4567 8901</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-0">
    <div class="relative h-[450px] sm:h-[500px]">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.6630388988083!2d112.70029127574368!3d-7.279127671536235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd2a5082ebbd%3A0xa415406a9930ca01!2sSPS%20Corporate%20Office!5e0!3m2!1sid!2sid!4v1767107052857!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            class="absolute inset-0">
        </iframe>

        <!-- Map Overlay Info -->
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent text-white p-6">
            <div class="container mx-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-xl font-bold mb-2">Kantor Pusat SPS Corporate</h3>
                        <p class="text-blue-100">Jl. Contoh Alamat No. 123, Jakarta Selatan</p>
                    </div>
                    <a href="https://maps.google.com/?q=SPS+Corporate+Office"
                        target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Pertanyaan <span class="text-blue-700">Umum</span>
                </h2>
                <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-gray-900">
                            Bagaimana cara menghubungi customer service?
                        </span>
                        <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">
                            Anda dapat menghubungi customer service kami melalui telepon di (021) 3456 7890 atau email ke support@spscorporate.co.id. Tim kami siap membantu dari Senin sampai Jumat, pukul 08.00 - 17.00 WIB.
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-gray-900">
                            Apakah SPS Corporate membuka peluang kerja sama?
                        </span>
                        <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">
                            Ya, kami selalu terbuka untuk kerja sama bisnis. Untuk informasi lebih lanjut mengenai partnership, silakan hubungi tim sales kami di sales@spscorporate.co.id atau telepon (021) 2345 6789.
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none">
                        <span class="font-semibold text-gray-900">
                            Berapa lama waktu respon untuk email yang dikirim?
                        </span>
                        <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-4 hidden">
                        <p class="text-gray-600">
                            Kami akan membalas email Anda dalam waktu 1-2 hari kerja. Untuk masalah yang lebih mendesak, silakan hubungi nomor telepon kantor kami langsung.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // FAQ Accordion
    document.querySelectorAll('.faq-section button').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('svg');

            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi.');
        }
    });

    // Add focus styles to form inputs
    document.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('ring-2', 'ring-blue-200');
        });

        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('ring-2', 'ring-blue-200');
        });
    });
</script>
@endpush

<style>
    /* Custom styles for better visual appeal */
    .rotate-180 {
        transform: rotate(180deg);
    }

    /* Smooth transitions */
    input,
    textarea,
    select {
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .contact-info {
            text-align: center;
        }

        .social-links {
            justify-content: center;
        }
    }

    /* Map hover effect */
    iframe {
        filter: grayscale(20%);
        transition: filter 0.3s ease;
    }

    iframe:hover {
        filter: grayscale(0%);
    }
</style>