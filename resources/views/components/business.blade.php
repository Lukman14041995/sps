<section id="business" class="py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-6 lg:px-16 xl:px-24">
        <!-- Header dengan badge -->
        <div class="text-center mb-20">
            <div class="inline-flex items-center justify-center mb-6">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-semibold tracking-wider uppercase">
                    Our Portfolio
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                SPS Corporate <span class="text-blue-700">Business Units</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-blue-700 mx-auto rounded-full mb-8"></div>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                Discover our diversified portfolio of businesses, each contributing to our legacy of excellence and innovation across multiple industries.
            </p>
        </div>

        <!-- Business Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            @php
            $businesses = [
            [
            'name' => 'Tissue Paper Manufacturer',
            'image' => asset('img/bussines/Tissue Paper.png'),
            'description' => 'High-quality tissue products for commercial and consumer markets',
            'icon' => '📄'
            ],
            [
            'name' => 'Paper Manufacturer',
            'image' => asset('img/bussines/Paper Manufacturer.jpg'),
            'description' => 'Premium paper products serving various industries since 1973',
            'icon' => '📜'
            ],
            [
            'name' => 'Packaging Manufacturer',
            'image' => asset('img/bussines/packaging.jpg'),
            'description' => 'Innovative packaging solutions for modern businesses',
            'icon' => '📦'
            ],
            [
            'name' => 'Construction Materials Manufacturer',
            'image' => asset('img/bussines/manufaktur.jpg'),
            'description' => 'Durable construction materials for infrastructure development',
            'icon' => '🏗️'
            ],
            [
            'name' => 'Property & Leisure',
            'image' => asset('img/bussines/property.jpg'),
            'description' => 'Strategic property development and leisure facilities',
            'icon' => '🏢'
            ],
            [
            'name' => 'Energy & Others',
            'image' => asset('img/bussines/other.jpg'),
            'description' => 'Power supply solutions and diversified investments',
            'icon' => '⚡'
            ],
            ];
            $fallback = asset('img/default-business.png');
            @endphp

            @foreach ($businesses as $business)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image Container dengan Gradient Overlay -->
                <div class="relative h-72 overflow-hidden">
                    <img
                        src="{{ $business['image'] }}"
                        alt="{{ $business['name'] }}"
                        onerror="this.onerror=null;this.src='{{ $fallback }}';"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-500"></div>

                    <!-- Icon Badge -->
                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm w-14 h-14 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl">{{ $business['icon'] }}</span>
                    </div>

                    <!-- Title on Image -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $business['name'] }}</h3>
                        <div class="w-12 h-1 bg-blue-400 rounded-full mb-3"></div>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="bg-white p-8">
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $business['description'] }}
                    </p>

                    <!-- Stats/Features -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <span>SPS Portfolio</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>Indonesia</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="#"
                        class="inline-flex items-center justify-between w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 group/btn">
                        <span class="font-medium">Explore Business</span>
                        <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Footer CTA -->
        <!-- <div class="text-center mt-16 pt-12 border-t border-gray-200">
            <p class="text-gray-600 mb-8">Looking for specific business solutions?</p>
            <a href="#contact"
                class="inline-flex items-center px-8 py-4 bg-white border-2 border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition-all duration-300 font-semibold group">
                <span>Contact Our Business Team</span>
                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div> -->
    </div>
</section>

<!-- AOS Animation -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-out-cubic'
    });
</script>

<style>
    /* Custom hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>