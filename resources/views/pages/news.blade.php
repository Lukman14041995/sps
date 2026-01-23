@extends('layouts.frontend')

@section('content')

{{-- ================= HERO ================= --}}
<section class="relative bg-blue-900">
    <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                class="w-full h-full object-cover" alt="News SPS Corporate"
                style="object-position:center 30%" loading="lazy">

            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
        </div>

        <div class="relative h-full flex items-center justify-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        News & <span class="text-blue-300">Updates</span>
                    </h1>

                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-6"></div>

                    <p class="text-blue-100 text-base sm:text-lg md:text-xl">
                        Informasi terbaru, perkembangan terkini, dan kegiatan SPS Corporate
                    </p>

                    {{-- SEARCH --}}
                    <form method="GET" action="{{ url('/news') }}" class="mt-8 max-w-2xl mx-auto">
                        <input type="hidden" name="category" value="{{ request('category') }}">

                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari berita..."
                                class="w-full px-6 py-4 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20
                                       text-white placeholder-white/70 focus:ring-2 focus:ring-blue-400">

                            <button type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700
                                       text-white p-3 rounded-lg">
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

{{-- ================= FEATURED ================= --}}
<section class="py-16 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold">
                <span class="text-blue-700">Highlight</span> Berita
            </h2>
            <p class="text-gray-600 mt-3">Berita utama dan perkembangan terpenting</p>
        </div>

        @if ($featuredNews)
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition lg:flex">

                <div class="lg:w-1/2">
                    <a href="{{ route('frontend.news.show', $featuredNews->slug) }}">
                        <img src="{{ Storage::disk('s3')->url($featuredNews->thumbnail_image) }}"
                            class="w-full h-72 lg:h-full object-cover" alt="{{ $featuredNews->title }}">
                    </a>
                </div>

                <div class="lg:w-1/2 p-8">

                    @if ($featuredNews->category)
                        <span class="inline-block px-3 py-1 mb-4 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ $featuredNews->category->name }}
                        </span>
                    @endif

                    <h3 class="text-2xl md:text-3xl font-bold mb-4">
                        <a href="{{ route('frontend.news.show', $featuredNews->slug) }}" class="hover:text-blue-700">
                            {{ $featuredNews->title }}
                        </a>
                    </h3>

                    <p class="text-gray-600 mb-6">{{ $featuredNews->excerpt }}</p>

                    <div class="flex justify-between text-sm text-gray-500">
                        <span>{{ $featuredNews->published_at->format('d M Y') }}</span>
                        <a href="{{ route('frontend.news.show', $featuredNews->slug) }}"
                            class="text-blue-600 font-semibold hover:text-blue-800">
                            Baca Selengkapnya →
                        </a>
                    </div>

                </div>
            </div>
        @endif

    </div>
</section>

{{-- ================= CATEGORY FILTER ================= --}}
<section class="py-10 bg-white border-t">
    <div class="container mx-auto px-4">

        <div class="flex flex-wrap justify-center gap-3">

            <a href="{{ url('/news') }}"
                class="px-5 py-2 rounded-full text-sm font-semibold transition
                {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Semua
            </a>

            @foreach ($categories as $cat)
                <a href="{{ url('/news?category=' . $cat->id) }}"
                    class="px-5 py-2 rounded-full text-sm font-medium transition
                    {{ request('category') == $cat->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ $cat->name }}
                </a>
            @endforeach

        </div>

    </div>
</section>

{{-- ================= NEWS GRID ================= --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">

        @if ($allNews->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($allNews as $news)
                    <article class="bg-white rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                        <a href="{{ route('frontend.news.show', $news->slug) }}">
                            <img src="{{ $news->thumbnail_image
                                ? Storage::disk('s3')->url($news->thumbnail_image)
                                : 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80' }}"
                                class="w-full h-48 object-cover" alt="{{ $news->title }}">
                        </a>

                        <div class="p-6">

                            <h3 class="font-bold text-lg mb-2 hover:text-blue-700">
                                <a href="{{ route('frontend.news.show', $news->slug) }}">{{ $news->title }}</a>
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 150) }}
                            </p>

                            <div class="flex justify-between text-sm text-gray-500">
                                <span>{{ $news->published_at?->format('M d, Y') ?? $news->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('frontend.news.show', $news->slug) }}"
                                    class="text-blue-600 font-semibold">Read →</a>
                            </div>

                        </div>
                    </article>
                @endforeach

            </div>

            @if ($allNews->hasPages())
                <div class="mt-12">
                    {{ $allNews->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <h3 class="text-xl font-semibold mb-2">Tidak ada berita ditemukan</h3>
                <p class="text-gray-600">Coba pilih kategori lain atau kata kunci berbeda</p>
            </div>
        @endif

    </div>
</section>

@endsection
