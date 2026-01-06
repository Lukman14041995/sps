@extends('admin.layouts.app')

@section('title', 'Create News Article')
@section('subtitle', 'Add a new news article to your website')

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

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            transform: translateX(400px);
            transition: .3s
        }

        .toast.show {
            transform: translateX(0)
        }

        /* New Styles */
        .form-section {
            transition: all 0.3s ease;
        }

        .form-section:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #D1D5DB;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s ease;
            background-color: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #F8FAFC;
        }

        .form-input:read-only {
            background-color: #F9FAFB;
            color: #6B7280;
            cursor: not-allowed;
        }

        .required-field::after {
            content: " *";
            color: #EF4444;
        }

        .preview-card {
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .preview-card:hover {
            transform: translateY(-2px);
        }

        .preview-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            background-color: #F3F4F6;
            color: #4B5563;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .status-draft {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-published {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-archived {
            background-color: #F3F4F6;
            color: #374151;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 10px;
            border: 2px solid #E5E7EB;
            transition: all 0.2s ease;
        }

        .radio-label:hover {
            border-color: #3B82F6;
            background-color: #F8FAFC;
        }

        .radio-label input:checked+.radio-custom {
            background-color: #3B82F6;
            border-color: #3B82F6;
        }

        .radio-label input:checked~span {
            color: #1F2937;
            font-weight: 600;
        }

        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid #9CA3AF;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .radio-custom::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: white;
            transform: scale(0);
            transition: transform 0.2s ease;
        }

        .radio-label input:checked+.radio-custom::after {
            transform: scale(1);
        }

        .file-input-container {
            position: relative;
            overflow: hidden;
            border: 2px dashed #D1D5DB;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #F9FAFB;
        }

        .file-input-container:hover {
            border-color: #3B82F6;
            background-color: #F8FAFC;
        }

        .file-input-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .file-input-icon {
            font-size: 24px;
            color: #6B7280;
        }

        .file-input-text {
            font-weight: 500;
            color: #4B5563;
        }

        .file-input-hint {
            font-size: 0.875rem;
            color: #9CA3AF;
        }

        .seo-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        .seo-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6, #EC4899);
            border-radius: 12px 12px 0 0;
        }

        .sticky-submit {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            border-top: 1px solid #E5E7EB;
            margin-left: -16px;
            margin-right: -16px;
            padding-left: 16px;
            padding-right: 16px;
        }

        .tooltip {
            position: relative;
        }

        .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #1F2937;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.875rem;
            font-weight: normal;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .progress-bar {
            height: 4px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6);
            border-radius: 2px;
            margin-top: 4px;
            transition: width 0.3s ease;
        }

        /* Image Preview Styles */
        .image-preview-container {
            position: relative;
            margin-top: 12px;
        }

        .image-preview {
            width: 100%;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #E5E7EB;
        }

        .remove-image {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .remove-image:hover {
            background-color: #DC2626;
            transform: scale(1.1);
        }

        /* Date Picker Fix */
        .flatpickr-input {
            cursor: pointer;
        }

        .flatpickr-calendar {
            border-radius: 12px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #E5E7EB !important;
        }

        /* Thumbnail Preview */
        .thumbnail-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
            margin-top: 12px;
        }

        .thumbnail-item {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #E5E7EB;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-[1920px] mx-auto px-4 py-6">

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ================= LEFT FORM ================= --}}
            <div class="lg:w-[70%] space-y-8">

                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf

                    {{-- BASIC INFORMATION --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 form-section">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-600"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Basic Information</h2>
                                    <p class="text-sm text-gray-600">Fill in the basic details of your article</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-8">

                            {{-- TITLE --}}
                            <div>
                                <label class="form-label required-field">Title</label>
                                <div class="relative">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
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
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" readonly
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
                                        /news/<span id="slugPreview">your-title</span>
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
                                    <textarea id="excerpt" name="excerpt" rows="3" class="form-input"
                                        placeholder="Brief summary of the article (optional)">{{ old('excerpt') }}</textarea>
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
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <input type="text" id="author" name="author"
                                            {{-- value="{{ old('author', auth()->user()->name) }}" class="form-input pl-11" --}}
                                            placeholder="Article author">
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
                                    <p class="text-sm text-gray-600">Write your article content here</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <textarea id="content" name="content" class="summernote">{{ old('content') }}</textarea>
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
                                <p class="text-sm text-gray-600">Upload article images</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <label class="form-label">Featured Image</label>
                                <div class="file-input-container" id="featuredImageContainer">
                                    <label class="file-input-label" id="featuredImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <input type="file" id="featured_image" name="featured_image" class="hidden"
                                            accept="image/*">
                                        <div class="file-input-text">Click to upload featured image</div>
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

                            <div>
                                <label class="form-label">Thumbnail Image</label>
                                <div class="file-input-container" id="thumbnailImageContainer">
                                    <label class="file-input-label" id="thumbnailImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <input type="file" id="thumbnail_image" name="thumbnail_image" class="hidden"
                                            accept="image/*">
                                        <div class="file-input-text">Click to upload thumbnail</div>
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
                                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                    class="form-input" placeholder="SEO title for search engines">
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="form-label">Meta Description</label>
                                    <span class="text-xs text-gray-500" id="metaDescCounter">0/160</span>
                                </div>
                                <textarea id="meta_description" name="meta_description" rows="3" class="form-input"
                                    placeholder="Brief description for search results">{{ old('meta_description') }}</textarea>
                            </div>

                            <div>
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    value="{{ old('meta_keywords') }}" class="form-input"
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
                                        <input type="radio" name="status" value="draft" checked class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-edit text-gray-500"></i>
                                            Draft
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="published" class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-gray-500"></i>
                                            Publish
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="archived" class="hidden">
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
                                    <input type="text" id="published_at" name="published_at"
                                        class="form-input flatpickr-input pl-11" placeholder="Select date and time"
                                        value="{{ old('published_at', now()->format('Y-m-d H:i')) }}">
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
                    <div
                        class="sticky-submit sticky bottom-0 p-6 rounded-xl shadow-lg flex justify-between items-center mt-8">
                        <div class="flex items-center gap-4">
                            <div id="formStatus" class="status-badge status-draft">
                                <i class="fas fa-edit"></i>
                                Draft
                            </div>
                            <div class="text-sm text-gray-600">
                                <span id="formProgress">0%</span> complete
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-10 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-3">
                            <i class="fas fa-plus-circle"></i>
                            Create Article
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
                                Your SEO Title Here
                            </p>
                            <p id="previewMetaUrl" class="text-sm opacity-90 truncate">
                                /news/your-article-title
                            </p>
                            <p id="previewMetaDesc" class="text-sm mt-2 opacity-90 truncate">
                                This is where your meta description will appear in search results.
                            </p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-start">
                                <div class="preview-badge" id="previewCategory">
                                    <i class="fas fa-tag mr-2"></i>
                                    Uncategorized
                                </div>
                                <div class="status-badge status-draft" id="previewStatus">
                                    <i class="fas fa-edit"></i>
                                    Draft
                                </div>
                            </div>

                            {{-- Featured Image Preview --}}
                            <div id="previewFeaturedImageContainer">
                                <img id="previewFeaturedImage"
                                    src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80"
                                    class="w-full rounded-xl preview-image shadow">
                            </div>

                            {{-- Thumbnail Image Preview --}}
                            <div class="mt-4">
                                <label class="text-sm font-medium text-gray-700 mb-2 block">Thumbnail Preview:</label>
                                <div id="previewThumbnailContainer" class="flex flex-wrap gap-2">
                                    <div id="previewThumbnailImage" class="thumbnail-item">
                                        <img id="previewThumbnailImg"
                                            src="https://via.placeholder.com/80x80/cccccc/969696?text=Thumbnail"
                                            alt="Thumbnail Preview">
                                    </div>
                                </div>
                            </div>

                            <h3 id="previewTitle" class="text-xl font-bold text-gray-800 preview-title mt-4">
                                Your article title will appear here
                            </h3>

                            <p id="previewExcerpt" class="text-gray-600 preview-excerpt">
                                This is where your article excerpt will show. Write a compelling summary to engage readers.
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700" id="previewAuthor">
                                            {{-- {{ auth()->user()->name }} --}}
                                        </p>
                                        <p class="text-xs text-gray-500" id="previewDate">
                                            {{ now()->format('M d, Y') }}
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
                                        <span id="featuredImageStatus" class="text-red-600">No</span> /
                                        <span id="thumbnailImageStatus" class="text-red-600">No</span>
                                    </span>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Content Length:</span>
                                    <span id="contentLength">0 words</span>
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
                                <span>Use descriptive titles for better SEO</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Add a compelling excerpt to increase clicks</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Include relevant images for engagement</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                <span>Optimize meta tags for search engines</span>
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
            // Initialize editors
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
                    onChange: function(contents) {
                        updateContentLength(contents);
                        updateSEOscore();
                    }
                }
            });

            // Initialize datepicker dengan konfigurasi yang benar
            const datepicker = flatpickr('#published_at', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                defaultDate: "{{ now()->format('Y-m-d H:i') }}",
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

            // SLUG generation
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

            // Character counters
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

            // Initialize counters
            updateCounter('#title', 120);
            updateCounter('#excerpt', 200);
            updateCounter('#meta_title', 60);
            updateCounter('#meta_description', 160);

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

            // Initial updates
            updateContentLength($('.summernote').summernote('code'));
            updateSEOscore();
        });
    </script>
@endpush
