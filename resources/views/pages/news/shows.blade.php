{{-- resources/views/frontend/news/show.blade.php --}}
@extends('layouts.frontend')

@section('content')

@php
    // Helper function untuk mendapatkan URL gambar dengan fallback
    function getNewsImageUrl($path) {
        if (!$path) {
            return 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
        }
        
        try {
            return Storage::disk('s3')->url($path);
        } catch (\Exception $e) {
            return 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';
        }
    }
@endphp

{{-- ================= HERO DETAIL ================= --}}
<section class="relative bg-blue-900">
    <div class="relative w-full h-[65vh] -mt-20 overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">

        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ getNewsImageUrl($news->thumbnail_image) }}"
                class="w-full h-full object-cover"
                alt="{{ $news->title }}"
                style="object-position:center 30%;"
                loading="lazy">

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-transparent to-blue-900/80"></div>
        </div>

        <!-- Content -->
        <div class="relative h-full flex items-center justify-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">

                    <!-- TITLE -->
                    <h1
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl
                               font-bold text-white mb-4 leading-tight">
                        {{ $news->title }}
                    </h1>

                    <!-- DIVIDER -->
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full mx-auto mb-5"></div>

                    <!-- META INFO -->
                    <div
                        class="flex flex-wrap items-center justify-center gap-3 sm:gap-4
                               text-white/90 text-xs sm:text-sm md:text-base">

                        @if ($news->category)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                                <span class="font-medium">{{ $news->category->name }}</span>
                            </div>
                        @endif

                        <!-- READ TIME -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @php
                                $wordCount = str_word_count(strip_tags($news->content));
                                $readingTime = max(1, ceil($wordCount / 200));
                            @endphp
                            <span>{{ $readingTime }} min read</span>
                        </div>

                        <!-- DATE -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>
                                {{ $news->published_at
                                    ? $news->published_at->format('d M Y')
                                    : $news->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <!-- VIEWS -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ number_format($news->views) }} views</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>


<!-- Main Content -->
<section class="py-8 sm:py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="lg:flex lg:gap-8">
                <!-- Main Content Area -->
                <div class="lg:w-2/3">
                    <!-- Article Content -->
                    <article class="prose prose-lg max-w-none">
                        <!-- Featured Image -->
                        <div class="mb-6 sm:mb-8 rounded-lg sm:rounded-xl overflow-hidden shadow-md sm:shadow-lg">
                            <img src="{{ getNewsImageUrl($news->thumbnail_image) }}"
                                class="w-full h-auto max-h-[400px] sm:max-h-[500px] object-cover"
                                alt="{{ $news->title }}" loading="lazy">
                        </div>

                        <!-- Content -->
                        <div class="text-gray-700 leading-relaxed text-sm sm:text-base md:text-lg">
                            {!! $news->content !!}
                        </div>

                        <!-- Tags -->
                        @if($news->tags && count($news->tags) > 0)
                        <div class="mt-8 sm:mt-10 pt-4 sm:pt-6 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @foreach($news->tags as $tag)
                                <span class="px-2 sm:px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs sm:text-sm">
                                    #{{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="mt-8 sm:mt-10 pt-4 sm:pt-6 border-t border-gray-200">
                            <h4 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Bagikan Artikel</h4>
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <button onclick="shareToFacebook()"
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                    <i class="fab fa-facebook-f text-xs sm:text-sm"></i>
                                </button>
                                <button onclick="shareToTwitter()"
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors">
                                    <i class="fab fa-twitter text-xs sm:text-sm"></i>
                                </button>
                                <button onclick="shareToLinkedIn()"
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-blue-700 text-white rounded-full hover:bg-blue-800 transition-colors">
                                    <i class="fab fa-linkedin-in text-xs sm:text-sm"></i>
                                </button>
                                <button onclick="copyLink()"
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-gray-600 text-white rounded-full hover:bg-gray-700 transition-colors">
                                    <i class="fas fa-link text-xs sm:text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Author Box (if author exists) -->
                        @if($news->author)
                        <div class="mt-8 sm:mt-10 bg-gray-50 rounded-lg sm:rounded-xl p-4 sm:p-6">
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600 text-sm sm:text-base"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-sm sm:text-base mb-1">Ditulis oleh</h5>
                                    <p class="text-gray-700 text-sm sm:text-base">{{ $news->author }}</p>
                                    @if($news->author_description)
                                    <p class="text-gray-600 text-xs sm:text-sm mt-1 sm:mt-2">{{ $news->author_description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </article>

                    <!-- Related Articles -->
                    @if($relatedNews->count() > 0)
                    <div class="mt-12 sm:mt-16">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Artikel Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            @foreach($relatedNews as $related)
                            <article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100">
                                <div class="flex">
                                    <div class="w-1/3">
                                        <!-- Gunakan thumbnail_image dengan fallback -->
                                        <img src="{{ getNewsImageUrl($related->thumbnail_image) }}"
                                            class="w-full h-28 sm:h-32 object-cover"
                                            alt="{{ $related->title }}">
                                    </div>
                                    <div class="w-2/3 p-3 sm:p-4">
                                        <h4 class="font-bold text-gray-900 text-sm sm:text-base mb-1 sm:mb-2 hover:text-blue-600 transition-colors">
                                            <a href="{{ route('frontend.news.show', $related->slug) }}">
                                                {{ Str::limit($related->title, 50) }}
                                            </a>
                                        </h4>
                                        <div class="flex items-center text-xs sm:text-sm text-gray-500">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3 mt-8 sm:mt-12 lg:mt-0">
                    <!-- Latest News Sidebar -->
                    <div class="bg-gray-50 rounded-lg sm:rounded-xl p-4 sm:p-6">
                        <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6">Berita Terbaru</h4>
                        <div class="space-y-4 sm:space-y-6">
                            @foreach($latestNews as $latest)
                            <div class="flex items-start space-x-3 sm:space-x-4 pb-4 sm:pb-6 border-b border-gray-200 last:border-0">
                                <div class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16">
                                    <img src="{{ getNewsImageUrl($latest->thumbnail_image) }}"
                                        class="w-full h-full object-cover rounded-lg"
                                        alt="{{ $latest->title }}">
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-sm sm:text-base mb-1 hover:text-blue-600 transition-colors">
                                        <a href="{{ route('frontend.news.show', $latest->slug) }}">
                                            {{ Str::limit($latest->title, 40) }}
                                        </a>
                                    </h5>
                                    <div class="text-xs sm:text-sm text-gray-500">
                                        {{ $latest->published_at ? $latest->published_at->format('M d, Y') : $latest->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Back to News List -->
                        <div class="mt-6 sm:mt-8">
                            <a href="{{ route('frontend.news.index') }}"
                                class="inline-flex items-center justify-center w-full px-3 py-2 sm:px-4 sm:py-3 bg-blue-600 text-white font-semibold text-sm sm:text-base rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2 text-xs sm:text-sm"></i>
                                Kembali ke Daftar Berita
                            </a>
                        </div>
                    </div>

                    <!-- Stats Widget -->
                    <div class="mt-4 sm:mt-6 bg-white rounded-lg sm:rounded-xl p-4 sm:p-6 shadow-sm border border-gray-100">
                        <h5 class="font-bold text-gray-900 text-base sm:text-lg mb-3 sm:mb-4">Statistik Artikel</h5>
                        <div class="space-y-2 sm:space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm sm:text-base">Views</span>
                                <span class="font-semibold text-gray-900 text-sm sm:text-base">{{ number_format($news->views) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm sm:text-base">Likes</span>
                                <span class="font-semibold text-gray-900 text-sm sm:text-base">{{ number_format($news->likes) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm sm:text-base">Shares</span>
                                <span class="font-semibold text-gray-900 text-sm sm:text-base">{{ number_format($news->shares) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm sm:text-base">Reading Time</span>
                                <span class="font-semibold text-gray-900 text-sm sm:text-base">{{ $readingTime }} min</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Share functions
    function shareToFacebook() {
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), '_blank');
    }

    function shareToTwitter() {
        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent('{{ $news->title }}'), '_blank');
    }

    function shareToLinkedIn() {
        window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(window.location.href), '_blank');
    }

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link berhasil disalin!');
        });
    }
</script>
@endpush

@push('styles')
<style>
    /* Custom styles for article content */
    .prose {
        color: #374151;
    }
    
    .prose h2 {
        color: #1f2937;
        font-weight: 700;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
        font-size: 1.5rem;
    }
    
    .prose h3 {
        color: #374151;
        font-weight: 600;
        margin-top: 1.25em;
        margin-bottom: 0.5em;
        font-size: 1.25rem;
    }
    
    .prose p {
        margin-bottom: 1em;
        line-height: 1.7;
    }
    
    .prose img {
        border-radius: 0.5rem;
        margin: 1em 0;
    }
    
    .prose ul, .prose ol {
        margin: 0.75em 0;
        padding-left: 1.25em;
    }
    
    .prose li {
        margin-bottom: 0.375em;
    }
    
    .prose blockquote {
        border-left: 3px solid #3b82f6;
        padding-left: 0.875em;
        font-style: italic;
        color: #4b5563;
        margin: 1.25em 0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .prose h2 {
            font-size: 1.25rem;
            margin-top: 1.25em;
        }
        
        .prose h3 {
            font-size: 1.125rem;
            margin-top: 1em;
        }
        
        .prose p {
            font-size: 0.9375rem;
            line-height: 1.6;
        }
    }
</style>
@endpush