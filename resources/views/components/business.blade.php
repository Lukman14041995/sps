<section id="business" class="bg-gray-50 py-16">
    <div class="w-full">

        <!-- HEADER -->
        <div class="max-w-7xl mx-auto px-6 lg:px-10 mb-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                SPS Corporate <span class="text-blue-700">Subholding</span>
            </h2>

            <div class="mt-4 w-24 h-1 mx-auto bg-gradient-to-r from-blue-500 to-blue-700 rounded-full"></div>
        </div>

        @php
            $businesses = [
                [
                    'name' => 'Tissue Paper Manufacturer',
                    'slug' => 'tissue-paper',
                    'logo' => asset('img/bussines/logo-tissue.png'),
                    'image' => asset('img/bussines/Tissue Paper.png'),
                    'gradient' => 'from-blue-900/80 via-blue-700/50 to-transparent',
                ],
                [
                    'name' => 'Paper Manufacturer',
                    'slug' => 'paper-manufacturer',
                    'logo' => asset('img/bussines/logo-paper.png'),
                    'image' => asset('img/bussines/Paper Manufacturer.jpg'),
                    'gradient' => 'from-indigo-900/80 via-indigo-700/50 to-transparent',
                ],
                [
                    'name' => 'Packaging Manufacturer',
                    'slug' => 'packaging',
                    'logo' => asset('img/bussines/logo-packaging.png'),
                    'image' => asset('img/bussines/packaging.jpg'),
                    'gradient' => 'from-emerald-900/80 via-emerald-700/50 to-transparent',
                ],
                [
                    'name' => 'Construction Materials',
                    'slug' => 'construction-materials',
                    'logo' => asset('img/bussines/logo-construction.png'),
                    'image' => asset('img/bussines/manufaktur.jpg'),
                    'gradient' => 'from-amber-900/80 via-amber-700/50 to-transparent',
                ],
                [
                    'name' => 'Property & Leisure',
                    'slug' => 'property-leisure',
                    'logo' => asset('img/bussines/logo-property.png'),
                    'image' => asset('img/bussines/property.jpg'),
                    'gradient' => 'from-purple-900/80 via-purple-700/50 to-transparent',
                ],
                [
                    'name' => 'Energy & Others',
                    'slug' => 'energy',
                    'logo' => asset('img/bussines/logo-energy.png'),
                    'image' => asset('img/bussines/other.jpg'),
                    'gradient' => 'from-cyan-900/80 via-cyan-700/50 to-transparent',
                ],
            ];
        @endphp

        <!-- MASONRY GRID -->
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-2 px-2 lg:px-4">

            @foreach ($businesses as $b)
                <a href="{{ url('/business/' . $b['slug']) }}"
                    class="group relative mb-2 block overflow-hidden bg-black break-inside-avoid">

                    <!-- IMAGE WRAPPER -->
                    <div class="relative overflow-hidden">

                        <!-- SKELETON -->
                        <div class="absolute inset-0 skeleton z-10"></div>

                        <!-- IMAGE (LQIP) -->
                        <img src="{{ $b['image'] }}" loading="lazy" decoding="async"
                            class="w-full object-cover scale-110 blur-lg
                               transition-all duration-700"
                            onload="
                            this.classList.remove('blur-lg');
                            this.previousElementSibling.remove();
                        ">

                        <!-- BASE DARK OVERLAY -->
                        <div class="absolute inset-0 bg-black/40"></div>

                        <!-- HOVER GRADIENT -->
                        <div
                            class="absolute inset-0 opacity-0 group-hover:opacity-100
                                bg-gradient-to-t {{ $b['gradient'] }}
                                transition duration-300">
                        </div>

                        <!-- GLASS EFFECT -->
                        <div
                            class="absolute inset-0 opacity-0 group-hover:opacity-100
                                backdrop-blur-md bg-white/10
                                transition duration-300">
                        </div>

                        <!-- LOGO -->
                        <div
                            class="absolute top-4 left-4 z-20
                                opacity-0 translate-y-2
                                group-hover:opacity-100 group-hover:translate-y-0
                                transition duration-300">
                            <div class="bg-white/90 backdrop-blur p-3 shadow-lg">
                                <img src="{{ $b['logo'] }}" class="h-10 object-contain">
                            </div>
                        </div>

                        <!-- CTA CENTER -->
                        <div
                            class="absolute inset-0 flex items-center justify-center z-20
                                opacity-0 group-hover:opacity-100
                                transition duration-300">
                            <span
                                class="px-6 py-3 text-sm font-semibold
                                   bg-white/90 backdrop-blur
                                   text-gray-900 shadow-lg
                                   transform scale-95 group-hover:scale-100
                                   transition">
                                View Detail →
                            </span>
                        </div>

                        <!-- TITLE -->
                        <div class="absolute bottom-4 left-4 right-4 z-20">
                            <h3
                                class="text-white text-base font-semibold inline-block relative
                                   after:block after:h-[2px] after:w-0
                                   after:bg-white after:mt-2
                                   after:transition-all after:duration-500
                                   group-hover:after:w-full">
                                {{ $b['name'] }}
                            </h3>
                        </div>

                    </div>
                </a>
            @endforeach

        </div>
    </div>
</section>
