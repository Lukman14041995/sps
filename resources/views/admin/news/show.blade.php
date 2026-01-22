@extends('admin.layouts.app')

@section('title', 'Article Details: ' . $news->title)
@section('subtitle', 'View article details and statistics')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .article-detail {
            transition: all 0.3s ease;
        }
        
        .article-detail:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .article-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px 16px 0 0;
            position: relative;
            overflow: hidden;
        }
        
        .article-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6, #EC4899);
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .meta-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .meta-badge-info {
            background-color: #E0F2FE;
            color: #0369A1;
        }
        
        .meta-badge-success {
            background-color: #D1FAE5;
            color: #065F46;
        }
        
        .meta-badge-warning {
            background-color: #FEF3C7;
            color: #92400E;
        }
        
        .meta-badge-secondary {
            background-color: #F3F4F6;
            color: #374151;
        }
        
        .article-image {
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .article-thumbnail {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .content-section {
            background-color: #F8FAFC;
            border-radius: 12px;
            padding: 24px;
            border-left: 4px solid #3B82F6;
        }
        
        .content-section h2 {
            color: #1F2937;
            border-bottom: 2px solid #E5E7EB;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 24px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #1F2937;
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #6B7280;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #E5E7EB;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -33px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #3B82F6;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #E5E7EB;
        }
        
        .timeline-date {
            font-weight: 600;
            color: #4B5563;
            margin-bottom: 4px;
        }
        
        .timeline-text {
            color: #6B7280;
            font-size: 0.95rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .btn-action {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .btn-edit {
            background-color: #3B82F6;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #2563EB;
            transform: translateY(-2px);
        }
        
        .btn-back {
            background-color: #6B7280;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #4B5563;
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background-color: #EF4444;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #DC2626;
            transform: translateY(-2px);
        }
        
        .seo-preview {
            background: linear-gradient(135deg, #1F2937 0%, #374151 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
            margin-bottom: 24px;
        }
        
        .seo-preview .url {
            color: #93C5FD;
            font-size: 0.875rem;
            margin-bottom: 8px;
        }
        
        .seo-preview .title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 8px;
            color: white;
        }
        
        .seo-preview .description {
            color: #D1D5DB;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .content-preview {
            max-height: 300px;
            overflow: hidden;
            position: relative;
        }
        
        .content-preview::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, #F8FAFC);
        }
        
        .show-more-btn {
            text-align: center;
            margin-top: 16px;
        }
        
        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }
        
        .tag {
            background-color: #F3F4F6;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 0.875rem;
            color: #4B5563;
        }
        
        @media (max-width: 768px) {
            .article-image {
                height: 250px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Action Buttons -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Article Details</h1>
                <p class="text-gray-600">View complete information about this article</p>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('admin.news.index') }}" class="btn-action btn-back">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('admin.news.edit', $news->id) }}" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i> Edit Article
                </a>
                <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this article?');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Article Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden article-detail mb-8">
            <!-- Article Header -->
            <div class="article-header p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <div class="flex items-center gap-4 mb-3">
                            <h1 class="text-3xl font-bold">{{ $news->title }}</h1>
                            <span class="meta-badge {{ $news->status === 'published' ? 'meta-badge-success' : ($news->status === 'draft' ? 'meta-badge-warning' : 'meta-badge-secondary') }}">
                                <i class="fas fa-{{ $news->status === 'published' ? 'check-circle' : ($news->status === 'draft' ? 'edit' : 'archive') }} mr-2"></i>
                                {{ ucfirst($news->status) }}
                            </span>
                        </div>
                        
                        <div class="article-meta">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user"></i>
                                <span class="font-medium">{{ $news->author ?? 'Unknown Author' }}</span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $news->created_at->format('F d, Y') }}</span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock"></i>
                                <span>{{ $news->created_at->format('h:i A') }}</span>
                            </div>
                            
                            @if($news->category)
                            <div class="flex items-center gap-2">
                                <i class="fas fa-folder"></i>
                                <span>{{ $news->category->name }}</span>
                            </div>
                            @endif
                            
                            @if($news->published_at)
                            <div class="flex items-center gap-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Published: {{ $news->published_at->format('M d, Y h:i A') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- URL Slug -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="text-sm opacity-90">Slug URL:</div>
                        <div class="font-mono text-sm">{{ $news->slug }}</div>
                        <div class="text-xs opacity-75 mt-1">
                            <i class="fas fa-external-link-alt mr-1"></i>
                            /news/{{ $news->slug }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Article Images -->
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <!-- Featured Image -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Featured Image</h3>
                        @if($news->featured_image)
                            <img src="{{ Storage::disk('s3')->url($news->featured_image) }}" 
                                 alt="{{ $news->title }}" 
                                 class="article-image w-full">
                        @else
                            <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-image text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-500">No featured image</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Thumbnail Image -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Thumbnail Image</h3>
                        @if($news->thumbnail_image)
                            <div class="flex flex-col items-center">
                                <img src="{{ Storage::disk('s3')->url($news->thumbnail_image) }}" 
                                     alt="{{ $news->title }} Thumbnail" 
                                     class="article-thumbnail mb-4">
                                <p class="text-sm text-gray-600">Preview size: 120×120px</p>
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-camera text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-500">No thumbnail image</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Excerpt -->
                @if($news->excerpt)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Excerpt</h3>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                        <p class="text-gray-700 italic">{{ $news->excerpt }}</p>
                    </div>
                </div>
                @endif

                <!-- Article Content -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Article Content</h3>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-file-alt mr-1"></i>
                            {{ str_word_count(strip_tags($news->content)) }} words
                        </div>
                    </div>
                    
                    <div class="content-section">
                        <div id="contentPreview" class="content-preview">
                            {!! $news->content !!}
                        </div>
                        <div class="show-more-btn">
                            <button onclick="toggleFullContent()" id="showMoreBtn" 
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-chevron-down mr-1"></i>
                                Show Full Content
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SEO Preview -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO Preview</h3>
                    <div class="seo-preview">
                        <div class="url">https://example.com/news/{{ $news->slug }}</div>
                        <div class="title">{{ $news->meta_title ?: $news->title }}</div>
                        <div class="description">{{ $news->meta_description ?: $news->excerpt ?: 'No meta description provided' }}</div>
                    </div>
                    
                    @if($news->meta_keywords)
                    <div class="mt-4">
                        <h4 class="font-medium text-gray-700 mb-2">Meta Keywords:</h4>
                        <div class="tag-list">
                            @foreach(explode(',', $news->meta_keywords) as $keyword)
                                <span class="tag">{{ trim($keyword) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Statistics Grid -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Article Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon bg-blue-100 text-blue-600">
                                <i class="fas fa-font"></i>
                            </div>
                            <div class="stat-number">{{ strlen($news->title) }}</div>
                            <div class="stat-label">Title Length</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon bg-green-100 text-green-600">
                                <i class="fas fa-file-word"></i>
                            </div>
                            <div class="stat-number">{{ str_word_count(strip_tags($news->content)) }}</div>
                            <div class="stat-label">Word Count</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon bg-purple-100 text-purple-600">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-number">
                                @if($news->published_at)
                                    {{ $news->published_at->diffForHumans() }}
                                @else
                                    Not Published
                                @endif
                            </div>
                            <div class="stat-label">Published</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon bg-yellow-100 text-yellow-600">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="stat-number">{{ $news->created_at->diffForHumans() }}</div>
                            <div class="stat-label">Created</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon bg-red-100 text-red-600">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="stat-number">{{ $news->updated_at->diffForHumans() }}</div>
                            <div class="stat-label">Last Updated</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon bg-indigo-100 text-indigo-600">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="stat-number">
                                @if($news->view_count)
                                    {{ number_format($news->view_count) }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="stat-label">Views</div>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Activity Timeline</h3>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-date">Created</div>
                            <div class="timeline-text">
                                <i class="fas fa-plus-circle text-green-500 mr-2"></i>
                                Article was created on {{ $news->created_at->format('F d, Y') }} at {{ $news->created_at->format('h:i A') }}
                            </div>
                        </div>
                        
                        @if($news->published_at)
                        <div class="timeline-item">
                            <div class="timeline-date">Published</div>
                            <div class="timeline-text">
                                <i class="fas fa-paper-plane text-blue-500 mr-2"></i>
                                Article was published on {{ $news->published_at->format('F d, Y') }} at {{ $news->published_at->format('h:i A') }}
                            </div>
                        </div>
                        @endif
                        
                        <div class="timeline-item">
                            <div class="timeline-date">Last Updated</div>
                            <div class="timeline-text">
                                <i class="fas fa-edit text-purple-500 mr-2"></i>
                                Article was last updated {{ $news->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <a href="{{ route('admin.news.edit', $news->id) }}" 
                   class="bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg p-4 text-center transition-colors">
                    <i class="fas fa-edit text-blue-600 text-2xl mb-2"></i>
                    <div class="font-medium text-blue-700">Edit Article</div>
                    <div class="text-sm text-blue-600">Modify content, images, or SEO</div>
                </a>
                
                <a href="{{ route('admin.news.index') }}" 
                   class="bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg p-4 text-center transition-colors">
                    <i class="fas fa-list text-gray-600 text-2xl mb-2"></i>
                    <div class="font-medium text-gray-700">View All Articles</div>
                    <div class="text-sm text-gray-600">Browse complete article list</div>
                </a>
                
                <a href="#" onclick="window.print()" 
                   class="bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg p-4 text-center transition-colors">
                    <i class="fas fa-print text-green-600 text-2xl mb-2"></i>
                    <div class="font-medium text-green-700">Print Article</div>
                    <div class="text-sm text-green-600">Generate printable version</div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleFullContent() {
            const contentPreview = document.getElementById('contentPreview');
            const showMoreBtn = document.getElementById('showMoreBtn');
            
            if (contentPreview.classList.contains('content-preview')) {
                // Show full content
                contentPreview.classList.remove('content-preview');
                contentPreview.style.maxHeight = 'none';
                showMoreBtn.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Show Less';
            } else {
                // Show preview
                contentPreview.classList.add('content-preview');
                contentPreview.style.maxHeight = '300px';
                showMoreBtn.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Show Full Content';
            }
        }
        
        // Format dates nicely
        document.addEventListener('DOMContentLoaded', function() {
            // Add copy slug functionality
            const slugElement = document.querySelector('.font-mono');
            if (slugElement) {
                slugElement.addEventListener('click', function() {
                    const slugText = this.textContent;
                    navigator.clipboard.writeText(slugText).then(function() {
                        const originalText = slugElement.innerHTML;
                        slugElement.innerHTML = '<i class="fas fa-check text-green-500 mr-1"></i> Copied!';
                        setTimeout(function() {
                            slugElement.innerHTML = originalText;
                        }, 2000);
                    });
                });
                slugElement.style.cursor = 'pointer';
                slugElement.title = 'Click to copy';
            }
            
            // Calculate reading time
            const wordCount = {{ str_word_count(strip_tags($news->content)) }};
            const readingTime = Math.ceil(wordCount / 200); // 200 words per minute
            const readingTimeElement = document.createElement('div');
            readingTimeElement.className = 'flex items-center gap-2';
            readingTimeElement.innerHTML = `<i class="fas fa-clock"></i><span>${readingTime} min read</span>`;
            
            // Add reading time to meta section
            const metaSection = document.querySelector('.article-meta');
            if (metaSection) {
                metaSection.appendChild(readingTimeElement);
            }
        });
    </script>
@endpush