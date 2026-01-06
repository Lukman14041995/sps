<header id="site-header" class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">

    <!-- Top Bar (Language & Contact) -->
    <div class="bg-gradient-to-r from-blue-800 to-blue-900 text-white py-2 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm">
            <!-- Contact Info -->
            <div class="flex items-center space-x-4">
                <a href="tel:+623199143888" class="flex items-center hover:text-blue-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    (+62) 31 991 43888
                </a>
                <span class="text-white/30">|</span>
                <a href="mailto:info@sunpaper.com" class="flex items-center hover:text-blue-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    info@sunpaper.com
                </a>
            </div>

            <!-- Language Switcher & Social -->
            <div class="flex items-center space-x-4">
                <!-- Social Media -->
                <div class="flex items-center space-x-3">
                    <a href="#" class="hover:text-blue-200 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#" class="hover:text-blue-200 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.17.056 1.97.24 2.428.403a4.92 4.92 0 0 1 1.775 1.015 4.92 4.92 0 0 1 1.015 1.775c.163.458.347 1.258.403 2.428.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.056 1.17-.24 1.97-.403 2.428a4.92 4.92 0 0 1-1.015 1.775 4.92 4.92 0 0 1-1.775 1.015c-.458.163-1.258.347-2.428.403-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.17-.056-1.97-.24-2.428-.403a4.92 4.92 0 0 1-1.775-1.015 4.92 4.92 0 0 1-1.015-1.775c-.163-.458-.347-1.258-.403-2.428C2.175 15.747 2.163 15.367 2.163 12s.012-3.584.07-4.849c.056-1.17.24-1.97.403-2.428a4.92 4.92 0 0 1 1.015-1.775 4.92 4.92 0 0 1 1.775-1.015c.458-.163 1.258-.347 2.428-.403C8.416 2.175 8.796 2.163 12 2.163z" />
                        </svg>
                    </a>
                    <a href="#" class="hover:text-blue-200 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                </div>

                <span class="text-white/30">|</span>

                <!-- Language Switcher -->
                <div class="relative group" x-data="{ open: false, currentLang: 'ID' }">
                    <button @click="open = !open"
                        class="flex items-center space-x-1 hover:text-blue-200 transition-colors">
                        <span class="text-sm font-medium" x-text="currentLang"></span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <button @click="currentLang = 'ID'; open = false; document.documentElement.lang = 'id';"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <div class="flex items-center">
                                <span class="mr-2">🇮🇩</span>
                                Bahasa Indonesia
                            </div>
                        </button>
                        <button @click="currentLang = 'EN'; open = false; document.documentElement.lang = 'en';"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <div class="flex items-center">
                                <span class="mr-2">🇺🇸</span>
                                English
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- LOGO -->
        <a href="/" class="flex items-center group">
            <div class="relative">
                <img src="{{ asset('img/logo/sps_logo.png') }}"
                    class="h-12 transition-transform duration-300 group-hover:scale-105"
                    alt="SPS Corporate Logo">
                <div class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-blue-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </div>
            <!-- <div class="ml-3 hidden lg:block">
                <div class="text-xl font-bold text-gray-900">SPS Corporate</div>
                <div class="text-xs text-gray-500 font-medium">Since 1973</div>
            </div> -->
        </a>

        <!-- DESKTOP MENU -->
        <nav class="hidden lg:flex items-center space-x-8">
            @php
            // Deteksi halaman aktif berdasarkan URL
            $currentPath = request()->path();
            $activeMenu = '';

            if ($currentPath === '/' || $currentPath === 'home') {
            $activeMenu = 'home';
            } elseif (str_contains($currentPath, 'about')) {
            $activeMenu = 'about';
            } elseif (str_contains($currentPath, 'business')) {
            $activeMenu = 'business';
            } elseif (str_contains($currentPath, 'news')) {
            $activeMenu = 'news';
            } elseif (str_contains($currentPath, 'csr')) {
            $activeMenu = 'csr';
            } elseif (str_contains($currentPath, 'career')) {
            $activeMenu = 'career';
            } elseif (str_contains($currentPath, 'contact')) {
            $activeMenu = 'contact';
            }
            @endphp

            <!-- Home -->
            <a href="/"
                class="nav-item relative group py-2 {{ $activeMenu === 'home' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'home' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    Home
                </span>
                <!-- Active Indicator -->
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'home' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                <!-- Active Dot -->
                @if($activeMenu === 'home')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- About Us -->
            <a href="/about"
                class="nav-item relative group py-2 {{ $activeMenu === 'about' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'about' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    About Us
                </span>
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'about' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                @if($activeMenu === 'about')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- Business Units Menu Item -->
            <a href="/business-units"
                class="nav-item relative flex items-center space-x-1 py-2 {{ $activeMenu === 'business' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
               {{ $activeMenu === 'business' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    Business Units
                </span>

                <!-- Active Indicator -->
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                   {{ $activeMenu === 'business' ? 'w-full' : 'w-0 hover:w-full' }} 
                   transition-all duration-300"></div>
                </div>

                @if($activeMenu === 'business')
                <div class="absolute -top-1 -right-6 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- News & Media -->
            <a href="/news"
                class="nav-item relative group py-2 {{ $activeMenu === 'news' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'news' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    News & Media
                </span>
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'news' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                @if($activeMenu === 'news')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- CSR -->
            <a href="/csr"
                class="nav-item relative group py-2 {{ $activeMenu === 'csr' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'csr' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    CSR
                </span>
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'csr' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                @if($activeMenu === 'csr')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- Career -->
            <a href="/career"
                class="nav-item relative group py-2 {{ $activeMenu === 'career' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'career' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    Career
                </span>
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'career' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                @if($activeMenu === 'career')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>

            <!-- Contact -->
            <a href="/contact"
                class="nav-item relative group py-2 {{ $activeMenu === 'contact' ? 'active' : '' }}">
                <span class="text-sm font-medium tracking-wide transition-colors duration-200 
                           {{ $activeMenu === 'contact' ? 'text-blue-700' : 'text-gray-700 hover:text-blue-700' }}">
                    Contact
                </span>
                <div class="absolute -bottom-1 left-0 w-full h-0.5">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-blue-700 
                               {{ $activeMenu === 'contact' ? 'w-full' : 'w-0 group-hover:w-full' }} 
                               transition-all duration-300"></div>
                </div>
                @if($activeMenu === 'contact')
                <div class="absolute -top-1 -right-2 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                @endif
            </a>
        </nav>

        <!-- CTA Button -->
        <div class="hidden lg:flex items-center space-x-4">
            <a href="/contact"
                class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg">
                Get In Touch
            </a>
        </div>

        <!-- MOBILE MENU BUTTON -->
        <button id="mobile-menu-button"
            class="lg:hidden flex flex-col space-y-1.5 p-2">
            <span class="w-6 h-0.5 bg-gray-700 transition-transform duration-300"></span>
            <span class="w-6 h-0.5 bg-gray-700 transition-transform duration-300"></span>
            <span class="w-6 h-0.5 bg-gray-700 transition-transform duration-300"></span>
        </button>
    </div>

    <!-- MOBILE MENU (Hidden by default) -->
    <div id="mobile-menu"
        class="lg:hidden fixed inset-0 top-32 bg-white z-40 transform -translate-x-full transition-transform duration-300 shadow-xl">
        <div class="px-6 py-8 space-y-1">
            @php
            $mobileActiveMenu = $activeMenu;
            @endphp

            <a href="/"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'home' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">Home</span>
                    @if($mobileActiveMenu === 'home')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/about"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'about' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">About Us</span>
                    @if($mobileActiveMenu === 'about')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/business-units"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'business' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">Business Units</span>
                    @if($mobileActiveMenu === 'business')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/news"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'news' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">News & Media</span>
                    @if($mobileActiveMenu === 'news')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/csr"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'csr' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">CSR</span>
                    @if($mobileActiveMenu === 'csr')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/career"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'career' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">Career</span>
                    @if($mobileActiveMenu === 'career')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <a href="/contact"
                class="mobile-nav-item block py-4 px-4 rounded-lg transition-colors duration-200 
                     {{ $mobileActiveMenu === 'contact' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }}">
                <div class="flex items-center justify-between">
                    <span class="font-medium">Contact</span>
                    @if($mobileActiveMenu === 'contact')
                    <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                    @endif
                </div>
            </a>

            <!-- Mobile Language Switcher -->
            <div class="pt-6 mt-6 border-t border-gray-200">
                <div class="flex items-center justify-center space-x-6">
                    <button class="flex items-center space-x-2 px-4 py-2 rounded-lg 
                                 {{ app()->getLocale() === 'id' ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <span class="text-lg">🇮🇩</span>
                        <span class="font-medium">ID</span>
                    </button>
                    <button class="flex items-center space-x-2 px-4 py-2 rounded-lg 
                                 {{ app()->getLocale() === 'en' ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <span class="text-lg">🇺🇸</span>
                        <span class="font-medium">EN</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Include Alpine.js for interactivity -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuSpans = mobileMenuButton.querySelectorAll('span');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('-translate-x-full');

            // Hamburger animation
            menuSpans[0].classList.toggle('rotate-45');
            menuSpans[0].classList.toggle('translate-y-2');
            menuSpans[1].classList.toggle('opacity-0');
            menuSpans[2].classList.toggle('-rotate-45');
            menuSpans[2].classList.toggle('-translate-y-2');
        });

        // Close mobile menu when clicking a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('-translate-x-full');
                menuSpans[0].classList.remove('rotate-45', 'translate-y-2');
                menuSpans[1].classList.remove('opacity-0');
                menuSpans[2].classList.remove('-rotate-45', '-translate-y-2');
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('site-header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg', 'bg-white');
                header.classList.remove('bg-white/95');
            } else {
                header.classList.remove('shadow-lg', 'bg-white');
                header.classList.add('bg-white/95');
            }
        });
    });
</script>

<style>
    /* Desktop Nav Item Styles */
    .nav-item {
        position: relative;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .nav-item.active span {
        color: #1d4ed8;
        font-weight: 600;
    }

    /* Mobile Nav Item Styles */
    .mobile-nav-item {
        position: relative;
        transition: all 0.3s ease;
    }

    .mobile-nav-item.active {
        background-color: #eff6ff;
        color: #1d4ed8;
    }

    /* Active Indicator Animation */
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Backdrop blur for modern browsers */
    .backdrop-blur-md {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
</style>