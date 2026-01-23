@extends('layouts.frontend')

@section('content')

{{-- ================= HERO CSR ================= --}}
<section class="relative bg-blue-900">
    <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">

        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover"
                alt="SPS Corporate CSR"
                style="object-position:center 30%;"
                loading="lazy">

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
        </div>

        <!-- Content -->
        <div class="relative h-full flex items-center justify-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">

                    <!-- TITLE -->
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                               font-bold text-white mb-4 leading-tight">
                        SPS Corporate
                        <span class="block text-blue-300 mt-2 sm:mt-3">CSR</span>
                    </h1>

                    <!-- DIVIDER -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <!-- DESCRIPTION -->
                    {{-- <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                        Komitmen SPS Corporate dalam memberikan dampak positif bagi masyarakat dan lingkungan
                    </p> --}}

                </div>
            </div>
        </div>

    </div>
</section>


<!-- About CSR Section -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div>
                    <div class="mb-8 sm:mb-10 lg:mb-12">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="text-sm font-semibold tracking-wider">OUR COMMITMENT</span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                            Komitmen <span class="text-blue-700">Sosial</span>
                        </h2>

                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mb-6 sm:mb-8"></div>
                    </div>

                    <div class="space-y-4 sm:space-y-6">
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            SPS Corporate menjalankan program Corporate Social Responsibility (CSR) sebagai wujud
                            tanggung jawab perusahaan terhadap masyarakat, lingkungan, dan pembangunan berkelanjutan.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Kami percaya bahwa kesuksesan bisnis harus sejalan dengan kontribusi positif bagi masyarakat
                            dan lingkungan sekitar tempat kami beroperasi.
                        </p>
                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                            Program CSR kami dirancang untuk memberikan manfaat jangka panjang, dengan melibatkan
                            berbagai pihak dan berfokus pada solusi nyata yang berkelanjutan.
                        </p>
                    </div>

                    <!-- CSR Impact Stats -->
                    @php
                        $totalCsr = \App\Models\Csr::published()->count();
                        $totalBeneficiaries = \App\Models\Csr::published()->sum('beneficiaries_count');
                        $categoriesCount = \App\Models\Csr::published()->distinct('category')->count('category');
                        $firstCsr = \App\Models\Csr::published()->oldest()->first();
                        $yearsActive = $firstCsr ? now()->year - $firstCsr->year : 0;
                    @endphp
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 mt-8 sm:mt-10">
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">{{ $totalCsr }}+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Program CSR</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">{{ number_format($totalBeneficiaries) }}+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Penerima Manfaat</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">{{ $categoriesCount }}</div>
                            <div class="text-xs sm:text-sm text-gray-600">Fokus Area</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-700 mb-1">{{ $yearsActive }}+</div>
                            <div class="text-xs sm:text-sm text-gray-600">Tahun</div>
                        </div>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="relative">
                    <div class="relative rounded-xl sm:rounded-2xl lg:rounded-3xl overflow-hidden shadow-lg sm:shadow-xl group">
                        @if($latestCsr = \App\Models\Csr::published()->latest()->first())
                            <img src="{{ Storage::disk('s3')->url($latestCsr->featured_image) }}"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"
                                alt="{{ $latestCsr->title }}"
                                loading="lazy">
                        @else
                            <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                class="w-full h-64 sm:h-72 md:h-80 lg:h-[400px] object-cover group-hover:scale-105 transition-transform duration-700"
                                alt="SPS Corporate CSR Activity"
                                loading="lazy">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <!-- Impact Card -->
                        <div class="absolute -bottom-4 sm:-bottom-6 -left-4 sm:-left-6 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg sm:shadow-xl w-48 sm:w-56 lg:w-64">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-green-600 mb-1 sm:mb-2">{{ $yearsActive }}+</div>
                                <div class="text-xs sm:text-sm text-gray-600 font-semibold">Tahun Berkomitmen</div>
                                <div class="w-12 sm:w-16 h-1 bg-gradient-to-r from-green-500 to-green-700 mx-auto mt-2 sm:mt-3 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSR Filter -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Program CSR Kami</h3>
                    <p class="text-sm text-gray-600">Filter berdasarkan kategori atau tahun</p>
                </div>
                
                <div class="flex flex-wrap gap-2">
                    <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ $key }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    
                    <select id="yearFilter" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSR Activities Grid -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Activities Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" id="csrGrid">
                @forelse($csrPrograms as $csr)
                <article class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 csr-card"
                         data-category="{{ $csr->category }}"
                         data-year="{{ $csr->year }}">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ Storage::disk('s3')->url($csr->featured_image) }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            alt="{{ $csr->title }}"
                            loading="lazy">
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            @php
                                $categoryColors = [
                                    'social' => 'bg-blue-600/90',
                                    'environment' => 'bg-green-600/90',
                                    'quality' => 'bg-emerald-600/90',
                                ];
                            @endphp
                            <span class="px-3 py-1 {{ $categoryColors[$csr->category] ?? 'bg-blue-600/90' }} text-white text-xs font-semibold rounded-full">
                                {{ $categories[$csr->category]['name'] ?? $csr->category }}
                            </span>
                        </div>
                        
                        <!-- Year Badge -->
                        <div class="absolute bottom-4 right-4">
                            <div class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                                <div class="text-xs font-bold text-gray-900">{{ \Carbon\Carbon::parse($csr->created_at)->format('d') }}</div>
                                <div class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($csr->created_at)->format('M') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors">
                            {{ $csr->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                            {{ $csr->excerpt ?? Str::limit(strip_tags($csr->content), 120) }}
                        </p>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500">Penerima Manfaat</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $csr->formatted_beneficiaries }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Anggaran</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $csr->formatted_budget }}</p>
                            </div>
                        </div>

                        <!-- Location & Year -->
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            @if($csr->location)
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $csr->location }}
                            </span>
                            @endif
                            @if($csr->year)
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $csr->year }}
                            </span>
                            @endif
                        </div>

                        <!-- Duration -->
                        @if($csr->duration)
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Durasi: {{ $csr->duration }}
                        </div>
                        @endif

                        <!-- Read More -->
                        <a href="{{ route('frontend.csr.show', $csr->slug) }}"
                            class="inline-flex items-center text-blue-600 font-medium text-sm group/link">
                            <span>Lihat Detail Program</span>
                            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada program CSR</h3>
                    <p class="mt-2 text-sm text-gray-600">Program CSR akan segera hadir.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($csrPrograms->hasPages())
            <div class="mt-12">
                {{ $csrPrograms->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</section>

<!-- CSR Focus Areas -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-transparent to-blue-500"></div>
                    <span class="mx-3 sm:mx-4 text-xs sm:text-sm font-semibold tracking-wider text-blue-600 uppercase">
                        Fokus Program
                    </span>
                    <div class="h-px w-8 sm:w-12 md:w-16 bg-gradient-to-r from-blue-500 to-transparent"></div>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    Fokus <span class="text-blue-700">Program CSR</span>
                </h2>

                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                    Pilar utama yang menjadi fokus program CSR SPS Corporate
                </p>
            </div>

            <!-- Focus Areas Grid -->
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                @foreach($categories as $key => $category)
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <!-- Icon -->
                        <div class="w-16 h-16 {{ $category['bg_color'] }} rounded-2xl flex items-center justify-center mb-6 mx-auto">
                            {!! $category['icon'] !!}
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 text-center group-hover:{{ $category['text_color'] }} transition-colors">
                            {{ $category['name'] }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm sm:text-base text-center leading-relaxed mb-6">
                            {{ $category['description'] }}
                        </p>

                        <!-- Programs Count -->
                        <div class="text-center">
                            @php
                                $count = \App\Models\Csr::published()->where('category', $key)->count();
                            @endphp
                            <div class="text-2xl font-bold {{ $category['text_color'] }}">{{ $count }}</div>
                            <div class="text-sm text-gray-500">Program</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const yearFilter = document.getElementById('yearFilter');
    const csrCards = document.querySelectorAll('.csr-card');
    
    function filterCsr() {
        const selectedCategory = categoryFilter.value;
        const selectedYear = yearFilter.value;
        
        csrCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardYear = card.dataset.year;
            
            const categoryMatch = !selectedCategory || cardCategory === selectedCategory;
            const yearMatch = !selectedYear || cardYear == selectedYear;
            
            if (categoryMatch && yearMatch) {
                card.style.display = 'block';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    }
    
    categoryFilter.addEventListener('change', filterCsr);
    yearFilter.addEventListener('change', filterCsr);
});
</script>
@endpush

<style>
    .csr-card {
        transition: all 0.3s ease;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>