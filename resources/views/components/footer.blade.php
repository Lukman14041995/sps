<footer class="bg-[#0a0a0a] text-white border-t border-gray-900">
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Main Footer -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Company Info -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-2xl font-bold mb-2">SPS Corporate</h3>
                    <div class="w-12 h-1 bg-blue-600 mb-4 rounded-full"></div>
                    <p class="text-gray-400 text-sm">
                        Building excellence since 1973 through diversified business leadership.
                    </p>
                </div>

                <!-- Contact -->
                <div class="space-y-3">
                    <div class="flex items-center text-gray-300">
                        <svg class="w-4 h-4 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm">Surabaya, Indonesia</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <svg class="w-4 h-4 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm">(+62) 31 991 43888</span>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            @php
            $links = [
            'Home' => '/',
            'About' => '/about',
            'Business' => '/business-units',
            'CSR' => '/csr',
            'Career' => '/career',
            'Contact' => '/contact',
            ];
            @endphp

            <div>
                <h4 class="font-semibold mb-4 text-gray-300">Navigation</h4>
                <ul class="space-y-2">
                    @foreach($links as $name => $url)
                    <li>
                        <a href="{{ url($url) }}" class="text-gray-400 hover:text-white text-sm transition-colors">
                            {{ $name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Businesses -->
            <div>
                <!-- <h4 class="font-semibold mb-4 text-gray-300">Businesses</h4>
                <ul class="space-y-2">
                    @foreach(['Paper', 'Packaging', 'Construction', 'Property', 'Energy'] as $item)
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">
                            {{ $item }}
                        </a>
                    </li>
                    @endforeach
                </ul> -->
            </div>

            <!-- Social & Legal -->
            <div class="space-y-6">
                <!-- Social -->
                <div>
                    <h4 class="font-semibold mb-4 text-gray-300">Connect</h4>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <span class="text-sm">f</span>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                            <span class="text-sm">ig</span>
                        </a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <span class="text-sm">in</span>
                        </a>
                    </div>
                </div>

                <!-- Legal -->
                <div class="pt-6 border-t border-gray-800">
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-800 mt-12 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <div>
                    © {{ date('Y') }} SPS Corporate. All rights reserved.
                </div>
                <div class="mt-2 md:mt-0">
                    PT SPS Corporate • Reg. No: 0123.456.789
                </div>
            </div>
        </div>
    </div>
</footer>