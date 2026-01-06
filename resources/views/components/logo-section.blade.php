<section id="partners" class="py-10 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-6 lg:px-20">
        <!-- Header yang lebih profesional -->
        <!-- <div class="text-center mb-20">
            <div class="inline-flex items-center justify-center mb-6">
                <div class="h-px w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                <span class="mx-4 text-sm font-semibold tracking-widest text-blue-600 uppercase">
                    Our Business Portfolio
                </span>
                <div class="h-px w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
            </div>
            
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-8">
                SPS Corporate <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Companies</span>
            </h2>
            
            <div class="max-w-3xl mx-auto">
                <p class="text-gray-600 text-lg md:text-xl leading-relaxed">
                    We manage a diverse group of respected companies specializing in various industries, each contributing to our vision of sustainable growth and excellence.
                </p>
            </div>
        </div> -->

        <!-- Enhanced Marquee Container -->
        <div class="relative">
            <!-- Gradient overlays untuk efek fade profesional -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10"></div>
            
            <!-- Marquee dengan efek lebih halus -->
            <div class="overflow-hidden py-8">
                <div id="marquee" class="flex animate-marquee space-x-16">
                    @php
                    $logos = [
                        asset('img/corporate/1.png'),
                        asset('img/corporate/2.jpg'),
                        asset('img/corporate/3.jpg'),
                        asset('img/corporate/4.jpg'),
                    ];
                    $fallback = asset('img/default-logo.png');
                    @endphp

                    @for ($i = 0; $i < 2; $i++) <!-- Loop 2x untuk seamless -->
                        @foreach ($logos as $index => $logo)
                        <div class="flex-shrink-0 group">
                            <div class="w-56 h-32 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 group-hover:border-blue-200 p-8 flex items-center justify-center">
                                <img
                                    src="{{ $logo }}"
                                    alt="Corporate Logo {{ $index + 1 }}"
                                    class="object-contain h-full w-full transition-all duration-500 group-hover:scale-110 grayscale group-hover:grayscale-0 opacity-80 group-hover:opacity-100"
                                    onerror="this.onerror=null;this.src='{{ $fallback }}';">
                            </div>
                            <!-- Company label -->
                            <div class="mt-4 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <p class="text-sm font-medium text-gray-700">Company {{ $index + 1 }}</p>
                                <div class="w-8 h-0.5 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mt-1 rounded-full"></div>
                            </div>
                        </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>

        <!-- Stats/Info Bar -->
        <!-- <div class="mt-20 pt-12 border-t border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto text-center">
                <div>
                    <div class="text-3xl font-bold text-blue-700 mb-2">4+</div>
                    <div class="text-sm text-gray-600">Companies</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-700 mb-2">50+</div>
                    <div class="text-sm text-gray-600">Years Experience</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-700 mb-2">Multi</div>
                    <div class="text-sm text-gray-600">Industries</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-700 mb-2">1</div>
                    <div class="text-sm text-gray-600">Corporate Vision</div>
                </div>
            </div>
        </div> -->
    </div>
</section>

<!-- Animasi CSS yang lebih smooth -->
<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(calc(-100% / 2));
        }
    }

    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 40s linear infinite;
        will-change: transform;
    }

    /* Pause on hover dengan efek smooth */
    #marquee {
        transition: animation-play-state 0.3s ease;
    }

    #marquee:hover {
        animation-play-state: paused;
    }

    /* Smooth transitions untuk semua elemen */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Gradient text untuk modern look */
    .bg-gradient-to-r {
        background-size: 200% auto;
    }
</style>