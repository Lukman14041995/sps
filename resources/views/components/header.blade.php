@php
    $current = request()->path();
@endphp

<header id="site-header" class="fixed top-0 w-full z-50 bg-transparent transition-all duration-300">

    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- LOGO -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('img/logo/sps_logo.png') }}" class="h-12" alt="Logo">
        </a>

        <!-- ================= DESKTOP MENU ================= -->
        <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium text-white">

            @foreach ([
        '/' => 'Home',
        'about' => 'About Us',
        'business-units' => 'Business Units',
        'news' => 'News & Media',
        'csr' => 'CSR',
        'career' => 'Career',
        'contact' => 'Contact',
    ] as $path => $label)
                @php
                    $isActive = $path === '/' ? $current === '/' : str_starts_with($current, $path);
                @endphp

                <a href="/{{ $path === '/' ? '' : $path }}" class="relative group">
                    <span class="hover:text-blue-300 transition">{{ $label }}</span>

                    <span
                        class="absolute left-0 -bottom-1 h-0.5 bg-white transition-all duration-300
                        {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}">
                    </span>

                    @if ($isActive)
                        <span class="absolute -top-1 -right-2 w-2 h-2 bg-white rounded-full"></span>
                    @endif
                </a>
            @endforeach

            <!-- LANGUAGE SWITCHER -->
            <div x-data="{ open: false, lang: 'ID' }" class="relative ml-4">
                <button @click="open=!open"
                    class="w-10 h-10 flex items-center justify-center rounded-full
                           border border-white/30 hover:bg-white/10 transition">
                    <span class="text-xl" x-text="lang === 'ID' ? '🇮🇩' : '🇺🇸'"></span>
                </button>

                <div x-show="open" @click.away="open=false"
                    class="absolute right-0 mt-2 w-36 bg-white text-gray-800
                           rounded-lg shadow-lg border z-50">
                    <button @click="lang='ID';open=false"
                        class="flex items-center w-full px-4 py-2 text-sm hover:bg-blue-50">
                        🇮🇩 <span class="ml-2">Indonesia</span>
                    </button>
                    <button @click="lang='EN';open=false"
                        class="flex items-center w-full px-4 py-2 text-sm hover:bg-blue-50">
                        🇺🇸 <span class="ml-2">English</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- CTA -->
        <a id="cta-btn" href="/contact"
            class="hidden lg:inline-block px-6 py-2.5 text-white rounded-lg
                   bg-[#062557] transition-all duration-300">
            Get In Touch
        </a>

        <!-- ================= HAMBURGER ================= -->
        <button id="mobile-btn" class="lg:hidden relative w-8 h-8 flex flex-col justify-center gap-1.5">
            <span class="bar w-full h-0.5 bg-white transition"></span>
            <span class="bar w-full h-0.5 bg-white transition"></span>
            <span class="bar w-full h-0.5 bg-white transition"></span>
        </button>
    </div>

    <!-- ================= OVERLAY ================= -->
    <div id="menu-overlay"
        class="fixed inset-0 bg-black/60 opacity-0 pointer-events-none
               transition-opacity duration-300 z-40">
    </div>

    <!-- ================= MOBILE MENU ================= -->
    <div id="mobile-menu"
        class="fixed top-0 right-0 w-80 max-w-full h-full
               bg-[#062557]
               transform translate-x-full
               transition-transform duration-300
               z-50 flex flex-col">

        <!-- MENU SCROLL AREA -->
        <nav class="flex-1 overflow-y-auto p-6 space-y-1 text-white">

            @foreach ([
        '/' => 'Home',
        'about' => 'About Us',
        'business-units' => 'Business Units',
        'news' => 'News & Media',
        'csr' => 'CSR',
        'career' => 'Career',
        'contact' => 'Contact',
    ] as $path => $label)
                @php
                    $isActive = $path === '/' ? $current === '/' : str_starts_with($current, $path);
                @endphp

                <a href="/{{ $path === '/' ? '' : $path }}"
                    class="relative flex items-center px-4 py-3 rounded-lg transition
                   {{ $isActive ? 'bg-white/15 font-semibold' : 'hover:bg-white/10' }}">

                    @if ($isActive)
                        <span class="absolute left-0 top-2 bottom-2 w-1 bg-white rounded"></span>
                    @endif

                    <span class="ml-2">{{ $label }}</span>
                </a>
            @endforeach
        </nav>

        <!-- ================= STICKY CTA ================= -->
        <div class="p-4 border-t border-white/20">
            <a href="/contact"
                class="block w-full text-center px-6 py-3
                      bg-blue-500 hover:bg-blue-600
                      text-white font-semibold rounded-lg transition">
                Get In Touch
            </a>
        </div>
    </div>
</header>

<!-- ALPINE -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const header = document.getElementById('site-header');
        const cta = document.getElementById('cta-btn');
        const btn = document.getElementById('mobile-btn');
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('menu-overlay');
        const bars = btn.querySelectorAll('.bar');

        let startX = 0;

        // HEADER SCROLL
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('bg-[#062557]', 'shadow-lg');
                header.classList.remove('bg-transparent');
                cta?.classList.replace('bg-[#062557]', 'bg-blue-500');
            } else {
                header.classList.remove('bg-[#062557]', 'shadow-lg');
                header.classList.add('bg-transparent');
                cta?.classList.replace('bg-blue-500', 'bg-[#062557]');
            }
        });

        function openMenu() {
            menu.classList.remove('translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            document.body.classList.add('overflow-hidden');

            bars[0].classList.add('rotate-45', 'translate-y-2');
            bars[1].classList.add('opacity-0');
            bars[2].classList.add('-rotate-45', '-translate-y-2');
        }

        function closeMenu() {
            menu.classList.add('translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.classList.remove('overflow-hidden');

            bars[0].classList.remove('rotate-45', 'translate-y-2');
            bars[1].classList.remove('opacity-0');
            bars[2].classList.remove('-rotate-45', '-translate-y-2');
        }

        btn.addEventListener('click', () => {
            menu.classList.contains('translate-x-full') ? openMenu() : closeMenu();
        });

        overlay.addEventListener('click', closeMenu);

        // CLOSE ON LINK CLICK
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        // SWIPE TO CLOSE
        menu.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
        });

        menu.addEventListener('touchmove', e => {
            const diff = e.touches[0].clientX - startX;
            if (diff > 80) closeMenu();
        });
    });
</script>
