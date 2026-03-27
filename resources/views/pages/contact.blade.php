@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-blue-900">
        <!-- Container dengan height yang terkontrol -->
        <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                    class="w-full h-full object-cover" alt="SPS Corporate Contact" style="object-position: center 30%;"
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
                        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-4 leading-tight">
                            SPS Corporate <span class="text-blue-300">Contact</span>
                        </h1>

                        <!-- Divider -->
                        <div class="w-24 h-2 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-8"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23062557"
            fill-opacity="0.02"%3E%3Cpath
            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
            /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

        <div class="relative container mx-auto px-4 md:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 md:mb-20">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    <span class="text-blue-600">Contact</span> Us
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-400 via-blue-600 to-blue-400 rounded-full mx-auto mb-8">
                </div>
                {{-- <p class="text-gray-600 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                    Ready to start a conversation? Reach out to us through any of the channels below
                </p> --}}
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-16 md:mb-20">
                <!-- Left Column: Contact Info -->
                <div class="space-y-8 lg:space-y-10">
                    <!-- Contact Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 border border-gray-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
                            Contact <span class="text-blue-600">Information</span>
                        </h3>

                        <div class="space-y-8">
                            <!-- Address -->
                            <div
                                class="group flex items-start gap-6 p-4 hover:bg-blue-50 rounded-xl transition-all duration-300">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">Our Office</h4>
                                    <p class="text-gray-600 leading-relaxed">
                                        Jl. Raya Kupang Baru No.27,<br>
                                        Dukuh Kupang, Kec. Dukuhpakis,<br>
                                        Surabaya, Jawa Timur 60225
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div
                                class="group flex items-start gap-6 p-4 hover:bg-green-50 rounded-xl transition-all duration-300">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">Phone Number</h4>
                                    <p class="text-gray-800 text-lg font-semibold mb-1">(031) 99143888</p>
                                    <p class="text-gray-500 text-sm">Monday – Friday, 08:00 – 17:00 WIB</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div
                                class="group flex items-start gap-6 p-4 hover:bg-purple-50 rounded-xl transition-all duration-300">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900 mb-2">Email Address</h4>
                                    <p class="text-gray-800 text-lg font-semibold mb-1">info@spscorporate.co.id</p>
                                    <p class="text-gray-800 text-lg font-semibold">sales@spscorporate.co.id</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    {{-- <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-8 md:p-10">
                        <h3 class="text-2xl font-bold text-white mb-6">Connect With Us</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="#"
                                class="group w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                <svg class="w-7 h-7 text-white group-hover:text-blue-400 transition-colors"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="group w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                <svg class="w-7 h-7 text-white group-hover:text-blue-400 transition-colors"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="group w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                <svg class="w-7 h-7 text-white group-hover:text-blue-700 transition-colors"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="group w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                                <svg class="w-7 h-7 text-white group-hover:text-pink-500 transition-colors"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.445 17.827c-3.684 1.684-9.401-9.43-5.8-11.308l1.053-.519 1.746 3.409-1.042.513c-1.095.587 1.185 5.04 2.305 4.497l1.032-.505 1.76 3.397-1.054.516z" />
                                </svg>
                            </a>
                        </div>
                    </div> --}}
                </div>

                <!-- Right Column: Google Maps -->
                <div class="h-[400px] md:h-[500px] lg:h-full rounded-2xl overflow-hidden shadow-2xl border border-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.6630388988083!2d112.70029127574368!3d-7.279127671536235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd2a5082ebbd%3A0xa415406a9930ca01!2sSPS%20Corporate%20Office!5e0!3m2!1sid!2sid!4v1767107052857!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="w-full h-full">
                    </iframe>
                </div>
            </div>

            <!-- Departments Section -->
            <div class="mb-16 md:mb-20">
                <div class="text-center mb-12">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Contact <span class="text-blue-600">Departments</span>
                    </h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Reach out to specific departments for specialized assistance
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Sales & Marketing -->
                    <div
                        class="group bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 border border-blue-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Sales & Marketing</h4>
                        <p class="text-gray-600 mb-6">
                            For product inquiries, pricing, and sales information
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-800 font-medium">sales@spscorporate.co.id</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-800 font-medium">(031) 99143888</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Support -->
                    <div
                        class="group bg-gradient-to-br from-green-50 to-white rounded-2xl p-8 border border-green-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Customer Support</h4>
                        <p class="text-gray-600 mb-6">
                            Technical assistance and support for our customers
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-800 font-medium">support@spscorporate.co.id</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-800 font-medium">(031) 99143888</span>
                            </div>
                        </div>
                    </div>

                    <!-- Career & Recruitment -->
                    <div
                        class="group bg-gradient-to-br from-purple-50 to-white rounded-2xl p-8 border border-purple-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Career & Recruitment</h4>
                        <p class="text-gray-600 mb-6">
                            Job opportunities and CV submissions
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-800 font-medium">career@spscorporate.co.id</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-800 font-medium">(031) 99143888</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 md:p-12 shadow-lg border border-gray-100">

                    <!-- Header -->
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">
                            Send Us a <span class="text-blue-600">Message</span>
                        </h3>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Fill out the form below and our team will contact you shortly.
                        </p>
                    </div>

                    <form method="POST" action="#" class="space-y-6">
                        @csrf

                        <!-- Row 1 -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Your full name">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="you@example.com">
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Phone Number
                                </label>
                                <input type="tel" name="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="+62 812 xxxx xxxx">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <select name="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg
                               bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="" disabled selected>Select subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="sales">Sales & Pricing</option>
                                    <option value="support">Customer Support</option>
                                    <option value="career">Career Opportunities</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="6" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                                placeholder="Write your message here..."></textarea>
                        </div>

                        <!-- Submit -->
                        <div class="text-center pt-4">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-10 py-3
                           bg-blue-600 text-white font-semibold rounded-lg
                           hover:bg-blue-700 transition shadow-md">
                                Send Message
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

    <style>
        /* Custom scrollbar for textarea */
        textarea::-webkit-scrollbar {
            width: 8px;
        }

        textarea::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.5);
            border-radius: 4px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.7);
        }

        /* Custom select dropdown styling */
        select option {
            background-color: #1f2937;
            color: white;
            padding: 12px;
        }

        /* Smooth transitions */
        * {
            transition-property: color, background-color, border-color, transform, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Map improvements */
        iframe {
            filter: grayscale(20%) contrast(110%);
            transition: filter 0.3s ease;
        }

        iframe:hover {
            filter: grayscale(0%) contrast(100%);
        }

        /* Fix untuk emoji loading */
        .emoji-loading-fix {
            opacity: 0;
            animation: fadeIn 0.3s ease forwards;
            animation-delay: 0.1s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>

    <script>
        // Fix untuk emoji loading
        document.addEventListener('DOMContentLoaded', function() {
            // Fix emoji loading dengan delay
            setTimeout(() => {
                const emojis = document.querySelectorAll('[class*="text-3xl"]');
                emojis.forEach(emoji => {
                    emoji.classList.add('emoji-loading-fix');
                });
            }, 100);

            // Form validation with improved UX
            const form = document.querySelector('form');
            if (form) {
                const inputs = form.querySelectorAll('input, textarea, select');

                // Add focus styles
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-500/50');
                    });

                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-500/50');
                        validateField(this);
                    });

                    // Real-time validation for required fields
                    input.addEventListener('input', function() {
                        if (this.hasAttribute('required')) {
                            validateField(this);
                        }
                    });
                });

                function validateField(field) {
                    const isValid = field.value.trim() !== '';

                    if (isValid) {
                        field.classList.remove('border-red-500');
                        field.classList.add('border-green-500/50');
                    } else {
                        field.classList.remove('border-green-500/50');
                        field.classList.add('border-red-500');
                    }

                    return isValid;
                }

                // Form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let isValid = true;
                    const requiredFields = form.querySelectorAll('[required]');

                    requiredFields.forEach(field => {
                        if (!validateField(field)) {
                            isValid = false;
                        }
                    });

                    if (isValid) {
                        // Show success animation
                        const submitBtn = form.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;

                        submitBtn.innerHTML = `
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Sending...
                        </span>
                    `;
                        submitBtn.disabled = true;

                        // Simulate API call
                        setTimeout(() => {
                            submitBtn.innerHTML = `
                            <span class="flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Message Sent!
                            </span>
                        `;
                            submitBtn.classList.remove('from-blue-600', 'to-blue-700');
                            submitBtn.classList.add('from-green-500', 'to-green-600');

                            // Reset form
                            setTimeout(() => {
                                form.reset();
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('from-green-500',
                                    'to-green-600');
                                submitBtn.classList.add('from-blue-600', 'to-blue-700');

                                // Reset field styles
                                inputs.forEach(input => {
                                    input.classList.remove('border-green-500/50',
                                        'border-red-500');
                                });
                            }, 2000);
                        }, 1500);
                    } else {
                        // Shake animation for invalid form
                        form.classList.add('animate-shake');
                        setTimeout(() => {
                            form.classList.remove('animate-shake');
                        }, 500);
                    }
                });

                // Add shake animation
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes shake {
                        0%, 100% { transform: translateX(0); }
                        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                        20%, 40%, 60%, 80% { transform: translateX(5px); }
                    }
                    .animate-shake {
                        animation: shake 0.5s ease-in-out;
                    }
                `;
                document.head.appendChild(style);
            }
        });
    </script>
@endsection
