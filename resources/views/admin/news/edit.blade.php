@extends('admin.layouts.app')

{{-- PERBAIKAN: Ubah title untuk edit --}}
@section('title', 'Edit News Article')
@section('subtitle', 'Edit an existing news article')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .preview-image {
            height: 200px;
            object-fit: cover
        }

        .preview-title {
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .preview-excerpt {
            -webkit-line-clamp: 3;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        /* ... (CSS lainnya tetap sama) ... */
    </style>
@endpush

@section('content')
    <div class="max-w-[1920px] mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- ================= LEFT FORM ================= --}}
            <div class="lg:w-[70%] space-y-8">

                {{-- PERBAIKAN: Ubah action dan method --}}
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf
                    @method('PUT') {{-- Penting untuk update --}}

                    {{-- BASIC INFORMATION --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-600"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Basic Information</h2>
                                    <p class="text-sm text-gray-600">Edit the basic details of your article</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-8">
                            {{-- TITLE --}}
                            <div>
                                <label class="form-label required-field">Title</label>
                                <div class="relative">
                                    {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                    <input type="text" id="title" name="title" 
                                           value="{{ old('title', $news->title) }}"
                                           class="form-input pl-11" placeholder="Enter article title" required>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-heading"></i>
                                    </div>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                        <span class="text-xs text-gray-500" id="titleCounter">0/120</span>
                                    </div>
                                </div>
                                <div class="progress-bar" id="titleProgress" style="width: 0%"></div>
                            </div>

                            {{-- SLUG --}}
                            <div>
                                <label class="form-label">Slug URL</label>
                                <div class="relative">
                                    {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                    <input type="text" id="slug" name="slug" 
                                           value="{{ old('slug', $news->slug) }}" readonly
                                           class="form-input pl-11" placeholder="Auto-generated from title">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-link"></i>
                                    </div>
                                    <button type="button" id="editSlug"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 mt-3 flex items-center gap-2">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    URL Preview:
                                    <span class="text-blue-600 font-medium">
                                        /news/<span id="slugPreview">{{ $news->slug ?: 'your-title' }}</span>
                                    </span>
                                </p>
                            </div>

                            {{-- EXCERPT --}}
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="form-label">Excerpt</label>
                                    <span class="text-xs text-gray-500" id="excerptCounter">0/200</span>
                                </div>
                                <div class="relative">
                                    {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                    <textarea id="excerpt" name="excerpt" rows="3" class="form-input"
                                        placeholder="Brief summary of the article (optional)">{{ old('excerpt', $news->excerpt) }}</textarea>
                                    <div class="absolute right-3 top-3 text-gray-400">
                                        <i class="fas fa-align-left"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-8">
                                {{-- CATEGORY --}}
                                <div>
                                    <label class="form-label">Category</label>
                                    <div class="relative">
                                        <select id="category_id" name="category_id"
                                            class="form-input appearance-none pl-11">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- AUTHOR --}}
                                <div>
                                    <label class="form-label">Author</label>
                                    <div class="relative">
                                        {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                        <input type="text" id="author" name="author"
                                            value="{{ old('author', $news->author ?? auth()->user()->name) }}" 
                                            class="form-input pl-11" placeholder="Article author">
                                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                                    <i class="fas fa-file-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Content</h2>
                                    <p class="text-sm text-gray-600">Edit your article content here</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            {{-- PERBAIKAN: Tambahkan value dari $news --}}
                            <textarea id="content" name="content" class="summernote">{{ old('content', $news->content) }}</textarea>
                        </div>
                    </div>

                    {{-- IMAGES --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                                <i class="fas fa-images text-green-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Images</h2>
                                <p class="text-sm text-gray-600">Update article images</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- FEATURED IMAGE --}}
                            <div>
                                <label class="form-label">Featured Image</label>
                                
                                {{-- PERBAIKAN: Tampilkan gambar yang sudah ada --}}
                                @if($news->featured_image)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $news->featured_image) }}" 
                                                 class="w-full h-40 object-cover rounded-lg border">
                                            <div class="mt-2 flex items-center gap-2 text-sm">
                                                <input type="checkbox" id="remove_featured_image" name="remove_featured_image" value="1">
                                                <label for="remove_featured_image" class="text-red-600 cursor-pointer">
                                                    <i class="fas fa-trash-alt mr-1"></i> Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="file-input-container" id="featuredImageContainer">
                                    <label class="file-input-label" id="featuredImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <input type="file" id="featured_image" name="featured_image" class="hidden"
                                            accept="image/*">
                                        <div class="file-input-text">
                                            {{ $news->featured_image ? 'Replace featured image' : 'Click to upload featured image' }}
                                        </div>
                                        <div class="file-input-hint">Recommended: 1200x630px, max 2MB</div>
                                    </label>
                                </div>
                                <div class="image-preview-container hidden" id="featuredImagePreview">
                                    <img class="image-preview" id="featuredPreviewImg" src=""
                                        alt="Featured Preview">
                                    <button type="button" class="remove-image" id="removeFeaturedImage">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- THUMBNAIL IMAGE --}}
                            <div>
                                <label class="form-label">Thumbnail Image</label>
                                
                                {{-- PERBAIKAN: Tampilkan gambar yang sudah ada --}}
                                @if($news->thumbnail_image)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $news->thumbnail_image) }}" 
                                                 class="w-32 h-32 object-cover rounded-lg border">
                                            <div class="mt-2 flex items-center gap-2 text-sm">
                                                <input type="checkbox" id="remove_thumbnail_image" name="remove_thumbnail_image" value="1">
                                                <label for="remove_thumbnail_image" class="text-red-600 cursor-pointer">
                                                    <i class="fas fa-trash-alt mr-1"></i> Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="file-input-container" id="thumbnailImageContainer">
                                    <label class="file-input-label" id="thumbnailImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <input type="file" id="thumbnail_image" name="thumbnail_image" class="hidden"
                                            accept="image/*">
                                        <div class="file-input-text">
                                            {{ $news->thumbnail_image ? 'Replace thumbnail image' : 'Click to upload thumbnail' }}
                                        </div>
                                        <div class="file-input-hint">Recommended: 400x300px, max 1MB</div>
                                    </label>
                                </div>
                                <div class="image-preview-container hidden" id="thumbnailImagePreview">
                                    <img class="image-preview" id="thumbnailPreviewImg" src=""
                                        alt="Thumbnail Preview">
                                    <button type="button" class="remove-image" id="removeThumbnailImage">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center">
                                <i class="fas fa-search text-yellow-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">SEO Optimization</h2>
                                <p class="text-sm text-gray-600">Optimize for search engines</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="form-label">Meta Title</label>
                                    <span class="text-xs text-gray-500" id="metaTitleCounter">0/60</span>
                                </div>
                                {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                <input type="text" id="meta_title" name="meta_title" 
                                       value="{{ old('meta_title', $news->meta_title) }}"
                                       class="form-input" placeholder="SEO title for search engines">
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="form-label">Meta Description</label>
                                    <span class="text-xs text-gray-500" id="metaDescCounter">0/160</span>
                                </div>
                                {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                <textarea id="meta_description" name="meta_description" rows="3" class="form-input"
                                    placeholder="Brief description for search results">{{ old('meta_description', $news->meta_description) }}</textarea>
                            </div>

                            <div>
                                <label class="form-label">Meta Keywords</label>
                                {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    value="{{ old('meta_keywords', $news->meta_keywords) }}" class="form-input"
                                    placeholder="keyword1, keyword2, keyword3">
                                <p class="text-xs text-gray-500 mt-2">
                                    Separate keywords with commas
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- PUBLISH --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                                <i class="fas fa-paper-plane text-red-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Publishing</h2>
                                <p class="text-sm text-gray-600">Configure publish settings</p>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <label class="form-label mb-4 block">Status</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        {{-- PERBAIKAN: Check sesuai dengan data $news --}}
                                        <input type="radio" name="status" value="draft" 
                                               {{ old('status', $news->status) === 'draft' ? 'checked' : '' }} class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-edit text-gray-500"></i>
                                            Draft
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="published" 
                                               {{ old('status', $news->status) === 'published' ? 'checked' : '' }} class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-gray-500"></i>
                                            Publish
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="archived" 
                                               {{ old('status', $news->status) === 'archived' ? 'checked' : '' }} class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-3">
                                            <i class="fas fa-archive text-gray-500"></i>
                                            Archive
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="form-label">Publish Date & Time</label>
                                <div class="relative">
                                    {{-- PERBAIKAN: Tambahkan value dari $news --}}
                                    <input type="text" id="published_at" name="published_at"
                                        class="form-input flatpickr-input pl-11" placeholder="Select date and time"
                                        value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i')) }}">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <button type="button" id="clearDate"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    Leave empty to use current date and time
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="sticky-submit sticky bottom-0 p-6 rounded-xl shadow-lg flex justify-between items-center mt-8">
                        <div class="flex items-center gap-4">
                            <div id="formStatus" class="status-badge status-draft">
                                <i class="fas fa-edit"></i>
                                <span id="statusText">{{ ucfirst($news->status) }}</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span id="formProgress">0%</span> complete
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-3">
                            <i class="fas fa-save"></i>
                            Update Article
                        </button>
                    </div>
                </form>
            </div>

            {{-- ================= RIGHT PREVIEW ================= --}}
            <div class="lg:w-[30%]">
                <div class="sticky top-8 space-y-8">
                    {{-- PREVIEW CARD --}}
                    <div class="preview-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="seo-preview relative">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="text-xs opacity-75 mb-1">example.com</div>
                            <p id="previewMetaTitle" class="text-lg font-semibold truncate">
                                {{ $news->meta_title ?: 'Your SEO Title Here' }}
                            </p>
                            <p id="previewMetaUrl" class="text-sm opacity-90 truncate">
                                /news/{{ $news->slug ?: 'your-article-title' }}
                            </p>
                            <p id="previewMetaDesc" class="text-sm mt-2 opacity-90 truncate">
                                {{ $news->meta_description ?: 'This is where your meta description will appear in search results.' }}
                            </p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-start">
                                <div class="preview-badge" id="previewCategory">
                                    <i class="fas fa-tag mr-2"></i>
                                    {{ $news->category->name ?? 'Uncategorized' }}
                                </div>
                                <div class="status-badge status-{{ $news->status }}" id="previewStatus">
                                    <i class="fas fa-{{ $news->status === 'published' ? 'check-circle' : ($news->status === 'archived' ? 'archive' : 'edit') }}"></i>
                                    {{ ucfirst($news->status) }}
                                </div>
                            </div>

                            {{-- Featured Image Preview --}}
                            <div id="previewFeaturedImageContainer">
                                @if($news->featured_image)
                                    <img id="previewFeaturedImage"
                                        src="{{ asset('storage/' . $news->featured_image) }}"
                                        class="w-full rounded-xl preview-image shadow">
                                @else
                                    <img id="previewFeaturedImage"
                                        src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80"
                                        class="w-full rounded-xl preview-image shadow">
                                @endif
                            </div>

                            {{-- Thumbnail Image Preview --}}
                            <div class="mt-4">
                                <label class="text-sm font-medium text-gray-700 mb-2 block">Thumbnail Preview:</label>
                                <div id="previewThumbnailContainer" class="flex flex-wrap gap-2">
                                    <div id="previewThumbnailImage" class="thumbnail-item">
                                        @if($news->thumbnail_image)
                                            <img id="previewThumbnailImg"
                                                src="{{ asset('storage/' . $news->thumbnail_image) }}"
                                                alt="Thumbnail Preview">
                                        @else
                                            <img id="previewThumbnailImg"
                                                src="https://via.placeholder.com/80x80/cccccc/969696?text=Thumbnail"
                                                alt="Thumbnail Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h3 id="previewTitle" class="text-xl font-bold text-gray-800 preview-title mt-4">
                                {{ $news->title ?: 'Your article title will appear here' }}
                            </h3>

                            <p id="previewExcerpt" class="text-gray-600 preview-excerpt">
                                {{ $news->excerpt ?: 'This is where your article excerpt will show. Write a compelling summary to engage readers.' }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700" id="previewAuthor">
                                            {{ $news->author ?: auth()->user()->name }}
                                        </p>
                                        <p class="text-xs text-gray-500" id="previewDate">
                                            {{ $news->published_at ? $news->published_at->format('M d, Y') : now()->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500 tooltip">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span id="previewReadTime">3 min read</span>
                                    <span class="tooltip-text">Estimated reading time based on content length</span>
                                </div>
                            </div>

                            <div class="pt-4 space-y-2">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Images Uploaded:</span>
                                    <span>
                                        <span id="featuredImageStatus" class="{{ $news->featured_image ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $news->featured_image ? 'Yes' : 'No' }}
                                        </span> /
                                        <span id="thumbnailImageStatus" class="{{ $news->thumbnail_image ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $news->thumbnail_image ? 'Yes' : 'No' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Content Length:</span>
                                    <span id="contentLength">{{ str_word_count(strip_tags($news->content)) }} words</span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>SEO Score:</span>
                                    <span id="seoScore" class="font-semibold text-green-600">0%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- QUICK TIPS --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-lightbulb text-yellow-500"></i>
                            Quick Tips
                        </h3>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Update titles regularly for better SEO</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Keep excerpts fresh and engaging</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Replace outdated images with new ones</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Review and update meta tags periodically</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            // ========== SUMMERNOTE INITIALIZATION & CONTENT HANDLING ==========
            // Initialize Summernote dengan konfigurasi yang memperbaiki content update
            $('.summernote').summernote({
                height: 350,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    // PASTIKAN: Update textarea saat content berubah
                    onChange: function(contents) {
                        // Force update ke textarea
                        $('#content').val(contents);
                        
                        // Debug di console
                        console.log('Summernote content changed:', contents.length + ' characters');
                        
                        updateContentLength(contents);
                        updateSEOscore();
                    },
                    onInit: function() {
                        console.log('Summernote initialized');
                    },
                    onBlur: function() {
                        // Update textarea saat Summernote kehilangan fokus
                        const contents = $(this).summernote('code');
                        $('#content').val(contents);
                        console.log('Summernote blurred, content saved');
                    }
                }
            });

            // Set initial content untuk Summernote dari database
            const initialContent = `{!! addslashes(old('content', $news->content)) !!}`;
            setTimeout(function() {
                $('.summernote').summernote('code', initialContent);
                // Pastikan textarea juga punya nilai awal
                $('#content').val(initialContent);
                console.log('Initial content set:', initialContent.length + ' characters');
            }, 300);

            // ========== CRITICAL FIX: Force update content sebelum form submit ==========
            $('#articleForm').on('submit', function(e) {
                // PASTIKAN INI: Update content dari Summernote ke textarea
                const summernoteContent = $('.summernote').summernote('code');
                
                // Force update ke textarea
                $('#content').val(summernoteContent);
                
                // Debug di console
                console.log('=== BEFORE SUBMIT ===');
                console.log('Summernote content:', summernoteContent.length + ' chars');
                console.log('Textarea value:', $('#content').val().length + ' chars');
                console.log('Content preview:', summernoteContent.substring(0, 100));
                
                // Validasi content tidak kosong
                if (!summernoteContent || summernoteContent.trim() === '' || 
                    summernoteContent === '<p><br></p>' || summernoteContent === '<p></p>') {
                    
                    console.warn('Content is empty or invalid!');
                    alert('Article content cannot be empty!');
                    e.preventDefault();
                    return false;
                }
                
                return true; // Lanjut submit
            });

            // Backup: Auto-update textarea setiap 500ms
            setInterval(function() {
                const currentContent = $('.summernote').summernote('code');
                const textareaContent = $('#content').val();
                
                if (textareaContent !== currentContent) {
                    $('#content').val(currentContent);
                    console.log('Auto-updated content');
                }
            }, 500);

            // ========== DATEPICKER INITIALIZATION ==========
            const initialPublishedAt = "{{ $news->published_at ? $news->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i') }}";
            const datepicker = flatpickr('#published_at', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                defaultDate: initialPublishedAt,
                minDate: "{{ now()->subYears(1)->format('Y-m-d') }}",
                maxDate: "{{ now()->addYears(5)->format('Y-m-d') }}",
                allowInput: true,
                clickOpens: true,
                onOpen: function(selectedDates, dateStr, instance) {
                    instance.set('enableTime', true);
                }
            });

            // Clear date button
            $('#clearDate').click(function() {
                datepicker.clear();
                $('#published_at').val('');
                $('#previewDate').text('{{ now()->format('M d, Y') }}');
            });

            // Update preview date ketika datepicker berubah
            $('#published_at').on('change', function() {
                const date = $(this).val();
                if (date) {
                    const formattedDate = new Date(date + ' UTC').toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    $('#previewDate').text(formattedDate);
                } else {
                    $('#previewDate').text('{{ now()->format('M d, Y') }}');
                }
            });

            // ========== SLUG GENERATION ==========
            function slugify(text) {
                return text.toLowerCase().trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }

            // Enable slug editing
            let isSlugEditable = false;
            $('#editSlug').click(function() {
                isSlugEditable = !isSlugEditable;
                const slugInput = $('#slug');
                if (isSlugEditable) {
                    slugInput.prop('readonly', false);
                    slugInput.removeClass('bg-gray-100');
                    slugInput.addClass('bg-white');
                    $(this).html('<i class="fas fa-lock text-green-600"></i>');
                } else {
                    slugInput.prop('readonly', true);
                    slugInput.removeClass('bg-white');
                    slugInput.addClass('bg-gray-100');
                    $(this).html('<i class="fas fa-edit text-blue-600"></i>');
                }
            });

            // ========== CHARACTER COUNTERS ==========
            function updateCounter(elementId, maxLength) {
                const element = $(elementId);
                const counter = $(elementId + 'Counter');
                const progress = $(elementId + 'Progress');

                element.on('input', function() {
                    const length = $(this).val().length;
                    counter.text(`${length}/${maxLength}`);

                    // Update progress bar
                    const percentage = (length / maxLength) * 100;
                    progress.css('width', Math.min(percentage, 100) + '%');

                    // Update color based on length
                    if (length > maxLength * 0.9) {
                        progress.css('background', '#EF4444');
                    } else if (length > maxLength * 0.7) {
                        progress.css('background', '#F59E0B');
                    } else {
                        progress.css('background', 'linear-gradient(90deg, #3B82F6, #8B5CF6)');
                    }

                    updateSEOscore();
                });

                // Initial count
                element.trigger('input');
            }

            // Initialize counters dengan data dari $news
            function updateCounterWithValue(elementId, maxLength, initialValue) {
                const element = $(elementId);
                const counter = $(elementId + 'Counter');
                const progress = $(elementId + 'Progress');
                
                // Set initial counter
                const length = initialValue ? initialValue.length : 0;
                counter.text(`${length}/${maxLength}`);
                
                const percentage = (length / maxLength) * 100;
                progress.css('width', Math.min(percentage, 100) + '%');
                
                // Update color based on length
                if (length > maxLength * 0.9) {
                    progress.css('background', '#EF4444');
                } else if (length > maxLength * 0.7) {
                    progress.css('background', '#F59E0B');
                } else {
                    progress.css('background', 'linear-gradient(90deg, #3B82F6, #8B5CF6)');
                }

                // Add input event
                element.on('input', function() {
                    const newLength = $(this).val().length;
                    counter.text(`${newLength}/${maxLength}`);
                    
                    const newPercentage = (newLength / maxLength) * 100;
                    progress.css('width', Math.min(newPercentage, 100) + '%');
                    
                    if (newLength > maxLength * 0.9) {
                        progress.css('background', '#EF4444');
                    } else if (newLength > maxLength * 0.7) {
                        progress.css('background', '#F59E0B');
                    } else {
                        progress.css('background', 'linear-gradient(90deg, #3B82F6, #8B5CF6)');
                    }
                    
                    updateSEOscore();
                });
            }

            // Initialize semua counters
            updateCounterWithValue('#title', 120, "{{ addslashes($news->title) }}");
            updateCounterWithValue('#excerpt', 200, "{{ addslashes($news->excerpt) }}");
            updateCounterWithValue('#meta_title', 60, "{{ addslashes($news->meta_title) }}");
            updateCounterWithValue('#meta_description', 160, "{{ addslashes($news->meta_description) }}");

            // ========== PREVIEW UPDATES ==========
            // Update preview functions
            $('#title').on('input', function() {
                const slug = slugify($(this).val());
                if (!isSlugEditable) {
                    $('#slug').val(slug);
                }
                $('#slugPreview').text(slug || 'your-title');
                $('#previewTitle').text($(this).val() || 'Your article title will appear here');
                $('#previewMetaUrl').text('example.com/news/' + (slug || 'your-title'));
                updateSEOscore();
            });

            $('#excerpt').on('input', function() {
                $('#previewExcerpt').text($(this).val() ||
                    'This is where your article excerpt will show. Write a compelling summary to engage readers.'
                    );
            });

            $('#author').on('input', function() {
                $('#previewAuthor').text($(this).val() || '{{ auth()->user()->name }}');
            });

            $('#meta_title').on('input', function() {
                $('#previewMetaTitle').text($(this).val() || 'Your SEO Title Here');
            });

            $('#meta_description').on('input', function() {
                $('#previewMetaDesc').text($(this).val() ||
                    'This is where your meta description will appear in search results.');
            });

            $('#category_id').on('change', function() {
                const selectedText = $('#category_id option:selected').text();
                $('#previewCategory').html('<i class="fas fa-tag mr-2"></i>' + (selectedText ||
                    'Uncategorized'));
            });

            // Status radio buttons
            $('input[name="status"]').change(function() {
                const status = $(this).val();
                const statusBadge = $('#previewStatus');
                const formStatus = $('#formStatus');

                statusBadge.removeClass().addClass('status-badge');
                formStatus.removeClass().addClass('status-badge');

                if (status === 'published') {
                    statusBadge.addClass('status-published').html(
                        '<i class="fas fa-check-circle"></i> Published');
                    formStatus.addClass('status-published').html(
                        '<i class="fas fa-check-circle"></i> Published');
                } else if (status === 'archived') {
                    statusBadge.addClass('status-archived').html('<i class="fas fa-archive"></i> Archived');
                    formStatus.addClass('status-archived').html('<i class="fas fa-archive"></i> Archived');
                } else {
                    statusBadge.addClass('status-draft').html('<i class="fas fa-edit"></i> Draft');
                    formStatus.addClass('status-draft').html('<i class="fas fa-edit"></i> Draft');
                }
            });

            // ========== IMAGE HANDLING ==========
            // Featured Image upload preview
            $('#featured_image').on('change', function() {
                if (this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update preview in form
                        $('#featuredImagePreview').removeClass('hidden');
                        $('#featuredPreviewImg').attr('src', e.target.result);
                        $('#featuredImageContainer').addClass('hidden');

                        // Update preview in preview card
                        $('#previewFeaturedImage').attr('src', e.target.result);
                        $('#featuredImageStatus').removeClass('text-red-600').addClass('text-green-600')
                            .text('Yes');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Remove featured image
            $('#removeFeaturedImage').click(function() {
                $('#featured_image').val('');
                $('#featuredImagePreview').addClass('hidden');
                $('#featuredImageContainer').removeClass('hidden');
                $('#featuredImageStatus').removeClass('text-green-600').addClass('text-red-600').text('No');

                // Reset preview image
                $('#previewFeaturedImage').attr('src',
                    'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80'
                    );
            });

            // Thumbnail Image upload preview
            $('#thumbnail_image').on('change', function() {
                if (this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update preview in form
                        $('#thumbnailImagePreview').removeClass('hidden');
                        $('#thumbnailPreviewImg').attr('src', e.target.result);
                        $('#thumbnailImageContainer').addClass('hidden');

                        // Update preview in preview card
                        $('#previewThumbnailImg').attr('src', e.target.result);
                        $('#thumbnailImageStatus').removeClass('text-red-600').addClass(
                            'text-green-600').text('Yes');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Remove thumbnail image
            $('#removeThumbnailImage').click(function() {
                $('#thumbnail_image').val('');
                $('#thumbnailImagePreview').addClass('hidden');
                $('#thumbnailImageContainer').removeClass('hidden');
                $('#thumbnailImageStatus').removeClass('text-green-600').addClass('text-red-600').text(
                'No');

                // Reset preview image
                $('#previewThumbnailImg').attr('src',
                    'https://via.placeholder.com/80x80/cccccc/969696?text=Thumbnail');
            });

            // ========== CONTENT & SEO CALCULATIONS ==========
            // Calculate content length
            function updateContentLength(content) {
                const text = $(content).text();
                const wordCount = text.trim().split(/\s+/).length;
                const charCount = text.length;

                $('#contentLength').text(wordCount + ' words');

                // Calculate read time (average 200 words per minute)
                const readTime = Math.ceil(wordCount / 200);
                $('#previewReadTime').text(readTime + ' min read');

                updateSEOscore();
            }

            // Calculate SEO score
            function updateSEOscore() {
                let score = 0;
                const maxScore = 100;

                // Title score (20 points)
                const titleLength = $('#title').val().length;
                if (titleLength >= 50 && titleLength <= 60) score += 20;
                else if (titleLength >= 40 && titleLength <= 70) score += 15;
                else if (titleLength > 0) score += 10;

                // Meta description score (20 points)
                const metaDescLength = $('#meta_description').val().length;
                if (metaDescLength >= 120 && metaDescLength <= 160) score += 20;
                else if (metaDescLength >= 80 && metaDescLength <= 200) score += 15;
                else if (metaDescLength > 0) score += 5;

                // Excerpt score (15 points)
                if ($('#excerpt').val().length > 0) score += 15;

                // Category score (10 points)
                if ($('#category_id').val()) score += 10;

                // Author score (5 points)
                if ($('#author').val()) score += 5;

                // Content score (30 points based on length)
                const contentText = $('.summernote').summernote('code');
                const wordCount = $(contentText).text().trim().split(/\s+/).length;
                if (wordCount >= 300) score += 30;
                else if (wordCount >= 200) score += 20;
                else if (wordCount >= 100) score += 10;

                // Update score display
                $('#seoScore').text(score + '%');
                if (score >= 80) {
                    $('#seoScore').removeClass('text-red-600 text-yellow-600').addClass('text-green-600');
                } else if (score >= 60) {
                    $('#seoScore').removeClass('text-red-600 text-green-600').addClass('text-yellow-600');
                } else {
                    $('#seoScore').removeClass('text-green-600 text-yellow-600').addClass('text-red-600');
                }

                // Update form progress
                const formProgress = Math.min(score, 100);
                $('#formProgress').text(formProgress + '%');
            }

            // ========== INITIAL SETUP ==========
            // Update status badge berdasarkan data awal
            const initialStatus = "{{ $news->status }}";
            const statusTextMap = {
                'draft': 'Draft',
                'published': 'Published',
                'archived': 'Archived'
            };
            const statusClassMap = {
                'draft': 'status-draft',
                'published': 'status-published',
                'archived': 'status-archived'
            };
            
            $('#formStatus').removeClass('status-draft').addClass(statusClassMap[initialStatus]);
            $('#statusText').text(statusTextMap[initialStatus]);

            // Set initial preview values dari $news
            $('#previewAuthor').text("{{ $news->author ?: auth()->user()->name }}");
            $('#previewDate').text("{{ $news->published_at ? $news->published_at->format('M d, Y') : now()->format('M d, Y') }}");
            
            // Initial updates
            setTimeout(function() {
                const content = $('.summernote').summernote('code');
                updateContentLength(content);
                updateSEOscore();
                console.log('Initial SEO score calculated');
            }, 500);

            // ========== DEBUG HELPER ==========
            // Fungsi untuk debug content
            window.debugContent = function() {
                console.log('=== DEBUG CONTENT ===');
                console.log('Summernote content:', $('.summernote').summernote('code'));
                console.log('Textarea value:', $('#content').val());
                console.log('Are they equal?', $('.summernote').summernote('code') === $('#content').val());
            };
        });
    </script>
@endpush