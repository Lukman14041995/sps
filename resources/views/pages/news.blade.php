@extends('layouts.frontend')

@section('content')

    <!-- Hero Section Responsif -->
    <section class="relative bg-blue-900">
        <!-- Container dengan height yang terkontrol -->
        <div class="relative h-[280px] sm:h-[320px] md:h-[380px] lg:h-[450px] xl:h-[500px] overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                    class="w-full h-full object-cover" alt="News SPS Corporate" style="object-position: center 30%;"
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
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                            News & <span class="text-blue-300">Updates</span>
                        </h1>

                        <!-- Divider -->
                        <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                        <!-- Description -->
                        <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                            Informasi terbaru, perkembangan terkini, dan kegiatan SPS Corporate
                        </p>

                        <!-- Search Form -->
                        <form method="GET" action="{{ url('/news') }}" class="mt-8 max-w-2xl mx-auto">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari berita..."
                                    class="w-full px-6 py-4 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                                <button type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        // Hitung statistik sederhana jika tidak ada variabel $stats
        $totalNews = $allNews->total(); // Total dari pagination
        $totalViews = 0;
        $totalLikes = 0;
        $totalShares = 0;

        foreach ($allNews as $news) {
            $totalViews += $news->views;
            $totalLikes += $news->likes;
            $totalShares += $news->shares;
        }
    @endphp

    <!-- Stats Section -->
    @if ($allNews->count() > 0)
        <section class="py-8 bg-gradient-to-r from-blue-50 to-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $totalNews }}</div>
                                    <div class="text-sm text-gray-600">Total Berita</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">{{ number_format($totalViews) }}</div>
                                    <div class="text-sm text-gray-600">Total Views</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">{{ number_format($totalLikes) }}</div>
                                    <div class="text-sm text-gray-600">Total Likes</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">{{ number_format($totalShares) }}</div>
                                    <div class="text-sm text-gray-600">Total Shares</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Featured News Section -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-10 sm:mb-12 lg:mb-16">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <span class="text-sm font-semibold tracking-wider">FEATURED STORY</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                        <span class="text-blue-700">Highlight</span> Berita
                    </h2>

                    <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                        Berita utama dan perkembangan terpenting dari SPS Corporate
                    </p>
                </div>

                <!-- Featured Article -->
                @if ($featuredNews)
                    <div
                        class="bg-white rounded-xl sm:rounded-2xl lg:rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="lg:flex">
                            <!-- Image Column -->
                            <div class="lg:w-1/2 relative">
                                <img src="{{ $featuredNews->getThumbnailUrl() }}"
                                    class="w-full h-64 sm:h-72 lg:h-full object-cover" alt="{{ $featuredNews->title }}"
                                    loading="lazy">
                            </div>

                            <!-- Content Column -->
                            <div class="lg:w-1/2 p-6 sm:p-8 lg:p-10">
                                <div class="mb-4">
                                    @if ($featuredNews->category)
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $featuredNews->category->name }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                                    <a href=""
                                        class="hover:text-blue-600 transition-colors">
                                        {{ $featuredNews->title }}
                                    </a>
                                </h2>
                                <p class="text-gray-600 mb-6 text-sm sm:text-base">
                                    {{ $featuredNews->excerpt }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $featuredNews->published_at->format('d M Y') }}
                                    </div>
                                    <a href=""
                                        class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Latest News Grid -->
    <section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-10 sm:mb-12 lg:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                        Berita <span class="text-blue-700">Terbaru</span>
                    </h2>
                    <div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6">
                    </div>
                    <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                        Kumpulan berita dan update terbaru dari SPS Corporate
                    </p>
                </div>

                <!-- Filter Section -->
                <div class="mb-10 sm:mb-12 bg-gray-50 rounded-xl p-4 sm:p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Category Filter -->
                        <div class="flex-1">
                            <div class="inline-flex bg-gray-100 rounded-full p-1 overflow-x-auto">
                                <a href="{{ url('/news') }}"
                                    class="px-4 sm:px-6 py-2 rounded-full {{ !request('category') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:text-blue-700' }} text-xs sm:text-sm font-semibold transition-all whitespace-nowrap">
                                    Semua Berita
                                </a>
                                @foreach ($categories as $category)
                                    <a href="{{ url('/news?category=' . $category->id) }}"
                                        class="px-4 sm:px-6 py-2 rounded-full {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'text-gray-700 hover:text-blue-700' }} text-xs sm:text-sm font-medium transition-colors whitespace-nowrap">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Date Filter Form -->
                        <form method="GET" action="{{ url('/news') }}" class="flex flex-col sm:flex-row gap-3">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">

                            <div class="flex items-center gap-2">
                                <label class="text-sm text-gray-600 whitespace-nowrap">Dari:</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="flex items-center gap-2">
                                <label class="text-sm text-gray-600 whitespace-nowrap">Sampai:</label>
                                <input type="date" name="date_to" value="{{ request('date_to') }}"
                                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm whitespace-nowrap">
                                Filter
                            </button>

                            @if (request()->hasAny(['search', 'category', 'date_from', 'date_to']))
                                <a href="{{ url('/news') }}"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm whitespace-nowrap">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- News Grid -->
                @if ($allNews->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach ($allNews as $news)
                            <article
                                class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ $news->getThumbnailUrl() ? asset('storage/' . $news->getThumbnailUrl()) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-700"
                                        alt="{{ $news->title }}" loading="lazy">
                                    <!-- Date Badge -->
                                    <div class="absolute top-4 left-4">
                                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                                            <div class="text-xs font-bold text-gray-900">
                                                {{ $news->published_at ? $news->published_at->format('d') : $news->created_at->format('d') }}
                                            </div>
                                            <div class="text-xs text-gray-600">
                                                {{ $news->published_at ? strtoupper($news->published_at->format('M')) : strtoupper($news->created_at->format('M')) }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Category Badge -->
                                    @if ($news->category)
                                        <div class="absolute top-4 right-4">
                                            @php
                                                $categoryColors = [
                                                    'CSR' => 'bg-green-600/90',
                                                    'Business' => 'bg-blue-600/90',
                                                    'Award' => 'bg-purple-600/90',
                                                    'Awards' => 'bg-purple-600/90',
                                                    'default' => 'bg-blue-600/90',
                                                ];
                                                $colorClass =
                                                    $categoryColors[$news->category->name] ??
                                                    $categoryColors['default'];
                                            @endphp
                                            <span
                                                class="px-3 py-1 {{ $colorClass }} text-white text-xs font-semibold rounded-full">
                                                {{ $news->category->name }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="px-3 py-1 bg-gray-600/90 text-white text-xs font-semibold rounded-full">
                                                Uncategorized
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            @php
                                                $wordCount = str_word_count(strip_tags($news->content));
                                                $readingTime = max(1, ceil($wordCount / 200));
                                            @endphp
                                            <span class="text-xs text-gray-500">{{ $readingTime }} min read</span>
                                        </div>
                                        <!-- Views -->
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ number_format($news->views) }}
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <h3
                                        class="text-lg sm:text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors line-clamp-2">
                                        <a href="">{{ $news->title }}</a>
                                    </h3>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-3">
                                        {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 150) }}
                                    </p>

                                    <!-- Author & Date -->
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                        <div class="flex items-center">
                                            @if ($news->author)
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>{{ $news->author }}</span>
                                            @endif
                                        </div>
                                        <span>{{ $news->published_at ? $news->published_at->format('M d, Y') : $news->created_at->format('M d, Y') }}</span>
                                    </div>

                                    <!-- Meta Bottom -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <!-- Read More -->
                                        <a href=""
                                            class="inline-flex items-center text-blue-600 font-medium text-sm group/link hover:text-blue-800">
                                            <span>Baca Selengkapnya</span>
                                            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>

                                        <!-- Stats -->
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center text-gray-500 text-xs">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                {{ number_format($news->likes) }}
                                            </div>
                                            <div class="flex items-center text-gray-500 text-xs">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                </svg>
                                                {{ number_format($news->shares) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($allNews->hasPages())
                        <div class="mt-12 lg:mt-16">
                            {{ $allNews->withQueryString()->links('vendor.pagination.tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12 lg:py-16">
                        <div class="mx-auto w-24 h-24 text-gray-400 mb-6">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada berita ditemukan</h3>
                        <p class="text-gray-600 mb-6">
                            @if (request()->hasAny(['search', 'category', 'date_from', 'date_to']))
                                Coba gunakan kata kunci lain atau hilangkan filter
                            @else
                                Belum ada berita yang dipublikasikan
                            @endif
                        </p>
                        @if (request()->hasAny(['search', 'category', 'date_from', 'date_to']))
                            <a href="{{ url('/news') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                Lihat Semua Berita
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Sidebar with Latest News -->
    @if ($latestNews->count() > 0)
        <section class="py-12 sm:py-16 md:py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-10 sm:mb-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Berita <span
                                class="text-blue-700">Terkini</span></h3>
                        <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full mx-auto mb-6"></div>
                        <p class="text-gray-600 text-base max-w-2xl mx-auto">
                            Artikel terbaru yang mungkin menarik untuk Anda
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($latestNews as $news)
                            <article
                                class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                                <!-- Image -->
                                <div class="relative">
                                    <img src="{{ $news->getThumbnailUrl() ? asset('storage/' . $news->getThumbnailUrl()) : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}"
                                        class="w-full h-48 object-cover" alt="{{ $news->title }}" loading="lazy">
                                    <!-- Category Badge -->
                                    @if ($news->category)
                                        <div class="absolute top-3 right-3">
                                            @php
                                                $categoryColors = [
                                                    'CSR' => 'bg-green-600',
                                                    'Business' => 'bg-blue-600',
                                                    'Award' => 'bg-purple-600',
                                                    'Awards' => 'bg-purple-600',
                                                    'default' => 'bg-blue-600',
                                                ];
                                                $colorClass =
                                                    $categoryColors[$news->category->name] ??
                                                    $categoryColors['default'];
                                            @endphp
                                            <span
                                                class="px-2 py-1 {{ $colorClass }} text-white text-xs font-semibold rounded">
                                                {{ $news->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <!-- Date -->
                                    <div class="flex items-center mb-3">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs text-gray-600">
                                            {{ $news->published_at ? $news->published_at->format('M d, Y') : $news->created_at->format('M d, Y') }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h4
                                        class="font-bold text-gray-900 mb-2 hover:text-blue-700 transition-colors line-clamp-2">
                                        <a href="">{{ $news->title }}</a>
                                    </h4>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed line-clamp-2">
                                        {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                                    </p>

                                    <!-- Read More -->
                                    <a href=""
                                        class="inline-flex items-center text-blue-600 font-medium text-sm hover:text-blue-800">
                                        <span>Baca Selengkapnya</span>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@push('styles')
    <style>
        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Card hover effects */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Responsive improvements */
        @media (max-width: 640px) {
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }

            .whitespace-nowrap {
                white-space: nowrap;
            }
        }

        /* Image optimization */
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>
@endpush
