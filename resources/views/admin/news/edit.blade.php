@extends('admin.layouts.app')

@section('title', 'Edit News Article')
@section('subtitle', 'Update an existing news article')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Improved color scheme */
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
        }

        .preview-image {
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        .preview-title {
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .preview-excerpt {
            -webkit-line-clamp: 3;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.6;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            transform: translateX(400px);
            transition: .3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Form Styles */
        .form-section {
            transition: all 0.3s ease;
            background: white;
            border-radius: 16px;
            overflow: hidden;
        }

        .form-section:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s ease;
            background-color: white;
            color: var(--gray-800);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background-color: white;
        }

        .form-input:read-only {
            background-color: var(--gray-50);
            color: var(--gray-600);
            cursor: not-allowed;
            border-color: var(--gray-200);
        }

        .required-field::after {
            content: " *";
            color: var(--danger-color);
        }

        /* Cards & Badges */
        .preview-card {
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background: white;
            border: 1px solid var(--gray-200);
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
            background-color: var(--gray-100);
            color: var(--gray-600);
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
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-archived {
            background-color: var(--gray-100);
            color: var(--gray-700);
        }

        /* Radio Buttons */
        .radio-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 12px 20px;
            border-radius: 10px;
            border: 2px solid var(--gray-200);
            transition: all 0.2s ease;
            flex: 1;
            min-width: 120px;
        }

        .radio-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .radio-label input:checked+.radio-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .radio-label input:checked~span {
            color: var(--gray-800);
            font-weight: 600;
        }

        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid var(--gray-300);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
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

        /* File Upload */
        .file-input-container {
            position: relative;
            overflow: hidden;
            border: 2px dashed var(--gray-300);
            border-radius: 12px;
            padding: 32px 24px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: var(--gray-50);
            cursor: pointer;
        }

        .file-input-container:hover {
            border-color: var(--primary-color);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .file-input-container.drag-over {
            border-color: var(--primary-color);
            background-color: rgba(79, 70, 229, 0.1);
        }

        .file-input-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .file-input-icon {
            font-size: 28px;
            color: var(--gray-500);
        }

        .file-input-text {
            font-weight: 600;
            color: var(--gray-700);
        }

        .file-input-hint {
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        /* Image Previews */
        .current-image-container {
            margin-bottom: 16px;
            padding: 16px;
            background-color: var(--gray-50);
            border-radius: 12px;
            border: 1px solid var(--gray-200);
        }

        .current-image {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .remove-image-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            color: var(--danger-color);
        }

        .remove-image-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* SEO Preview */
        .seo-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 20px;
            color: white;
            position: relative;
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

        /* Sticky Submit */
        .sticky-submit {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            border-top: 1px solid var(--gray-200);
            margin-left: -16px;
            margin-right: -16px;
            padding-left: 16px;
            padding-right: 16px;
            position: sticky;
            bottom: 0;
            z-index: 100;
        }

        /* Tooltips */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--gray-800);
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1000;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.875rem;
            font-weight: normal;
            pointer-events: none;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Progress Bars */
        .progress-bar {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #8B5CF6);
            border-radius: 2px;
            margin-top: 4px;
            transition: width 0.3s ease;
        }

        /* Image Previews */
        .image-preview-container {
            position: relative;
            margin-top: 16px;
            transition: all 0.3s ease;
        }

        .image-preview {
            width: 100%;
            height: 200px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .remove-image {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            z-index: 10;
        }

        .remove-image:hover {
            background-color: #dc2626;
            transform: scale(1.1);
        }

        /* Select2 Customization */
        .select2-container .select2-selection--single {
            height: 48px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 48px;
            padding-left: 16px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px;
            right: 10px;
        }

        /* Validation States */
        .is-invalid {
            border-color: var(--danger-color) !important;
        }

        .is-valid {
            border-color: var(--success-color) !important;
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 4px;
        }

        /* Loading State */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .radio-group {
                flex-direction: column;
            }

            .radio-label {
                width: 100%;
            }

            .sticky-submit {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                margin: 0;
                padding: 16px;
                border-radius: 0;
            }
        }

        /* Summernote Fix */
        .note-editor.note-frame {
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            overflow: hidden;
        }

        .note-editor.note-frame .note-toolbar {
            background-color: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
            padding: 10px;
        }

        .note-editor.note-frame .note-editing-area {
            background: white;
        }

        .note-editor.note-frame .note-statusbar {
            background-color: var(--gray-50);
            border-top: 1px solid var(--gray-200);
        }
    </style>
@endpush

@section('content')
    <div class="max-w-[1920px] mx-auto px-4 py-6">

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-red-800">Please fix the following errors:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ================= LEFT FORM ================= --}}
            <div class="lg:w-[70%] space-y-8">

                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
                    id="articleForm">
                    @csrf
                    @method('PUT')

                    {{-- BASIC INFORMATION --}}
                    <div class="form-section">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-info-circle text-blue-600"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Basic Information</h2>
                                    <p class="text-sm text-gray-600">Update the basic details of your article</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-8">

                            {{-- TITLE --}}
                            <div>
                                <label class="form-label required-field">Title</label>
                                <div class="relative">
                                    <input type="text" id="title" name="title"
                                        value="{{ old('title', $news->title) }}"
                                        class="form-input pl-11 {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                        placeholder="Enter article title" required maxlength="120">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-heading"></i>
                                    </div>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                        <span class="text-xs text-gray-500" id="titleCounter">0/120</span>
                                    </div>
                                </div>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @endif
                                <div class="progress-bar" id="titleProgress" style="width: 0%"></div>
                            </div>

                            {{-- SLUG --}}
                            <div>
                                <label class="form-label required-field">Slug URL</label>
                                <div class="relative">
                                    <input type="text" id="slug" name="slug"
                                        value="{{ old('slug', $news->slug) }}"
                                        class="form-input pl-11 {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                        placeholder="Auto-generated from title" required maxlength="255" readonly>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-link"></i>
                                    </div>
                                    <button type="button" id="editSlug"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800 bg-transparent border-none cursor-pointer">
                                        <i class="fas fa-edit text-sm"></i>
                                    </button>
                                </div>
                                @if ($errors->has('slug'))
                                    <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
                                @endif
                                <p class="text-sm text-gray-500 mt-3 flex items-center gap-2">
                                    <i class="fas fa-external-link-alt text-xs"></i>
                                    URL Preview:
                                    <span class="text-blue-600 font-medium">
                                        {{ url('/news') }}/<span id="slugPreview">{{ $news->slug ?: 'your-title' }}</span>
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
                                        placeholder="Brief summary of the article (optional)" maxlength="200">{{ old('excerpt', $news->excerpt) }}</textarea>
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
                                            class="form-input appearance-none pl-11 w-full">
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
                                        <div
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                {{-- AUTHOR --}}
                                <div>
                                    <label class="form-label">Author</label>
                                    <div class="relative">
                                        <input type="text" id="author" name="author"
                                            value="{{ old('author', $news->author ?? auth()->user()->name) }}"
                                            class="form-input pl-11" placeholder="Article author" maxlength="100">
                                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="form-section">
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
                            {{-- Hidden input yang akan diisi oleh JavaScript --}}
                            <input type="hidden" id="content_hidden" name="content"
                                value="{{ old('content', $news->content) }}">

                            {{-- Summernote editor --}}
                            <div id="summernote"></div>

                            @if ($errors->has('content'))
                                <div class="invalid-feedback mt-2">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- IMAGES --}}
                    <div class="form-section p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                                <i class="fas fa-images text-green-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Images</h2>
                                <p class="text-sm text-gray-600">Update article images (Max: Featured 2MB, Thumbnail 1MB)
                                </p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            {{-- FEATURED IMAGE --}}
                            <div>
                                <label class="form-label">Featured Image</label>

                                {{-- Current Featured Image --}}
                                @if ($news->featured_image)
                                    <div class="current-image-container">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                                        <div class="flex items-start gap-4">
                                            {{-- PERBAIKAN: Ganti featured_url dengan featured_image_url --}}
                                            <img src="{{ $news->featured_image_url }}" class="current-image"
                                                onerror="this.src='https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80'">
                                            <div class="flex-1">
                                                <label class="remove-image-checkbox">
                                                    <input type="checkbox" id="remove_featured_image"
                                                        name="remove_featured_image" value="1"
                                                        {{ old('remove_featured_image') ? 'checked' : '' }}>
                                                    <span>Remove current image</span>
                                                </label>
                                                <p class="text-xs text-gray-500 mt-2">
                                                    Check this box to remove the current image
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Featured Image Upload --}}
                                <div class="file-input-container" id="featuredImageContainer">
                                    <label class="file-input-label" id="featuredImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <input type="file" id="featured_image" name="featured_image" class="hidden"
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                        <div class="file-input-text">
                                            {{ $news->featured_image ? 'Replace featured image' : 'Click to upload featured image' }}
                                        </div>
                                        <div class="file-input-hint">Recommended: 1200x630px • Max 2MB</div>
                                    </label>
                                </div>
                                <div class="image-preview-container hidden" id="featuredImagePreview">
                                    <img class="image-preview" id="featuredPreviewImg" src=""
                                        alt="Featured Preview">
                                    <button type="button" class="remove-image" id="removeFeaturedImage">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @if ($errors->has('featured_image'))
                                    <div class="invalid-feedback">{{ $errors->first('featured_image') }}</div>
                                @endif
                            </div>

                            {{-- THUMBNAIL IMAGE --}}
                            <div>
                                <label class="form-label">Thumbnail Image</label>

                                {{-- Current Thumbnail Image --}}
                                @if ($news->thumbnail_image)
                                    <div class="current-image-container">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                                        <div class="flex items-start gap-4">
                                            {{-- Thumbnail sudah benar menggunakan thumbnail_url --}}
                                            <img src="{{ $news->thumbnail_url }}" class="current-image"
                                                onerror="this.src='https://via.placeholder.com/80x80/cccccc/969696?text=No+Image'">
                                            <div class="flex-1">
                                                <label class="remove-image-checkbox">
                                                    <input type="checkbox" id="remove_thumbnail_image"
                                                        name="remove_thumbnail_image" value="1"
                                                        {{ old('remove_thumbnail_image') ? 'checked' : '' }}>
                                                    <span>Remove current image</span>
                                                </label>
                                                <p class="text-xs text-gray-500 mt-2">
                                                    Check this box to remove the current image
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Thumbnail Image Upload --}}
                                <div class="file-input-container" id="thumbnailImageContainer">
                                    <label class="file-input-label" id="thumbnailImageLabel">
                                        <div class="file-input-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <input type="file" id="thumbnail_image" name="thumbnail_image" class="hidden"
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                        <div class="file-input-text">
                                            {{ $news->thumbnail_image ? 'Replace thumbnail image' : 'Click to upload thumbnail' }}
                                        </div>
                                        <div class="file-input-hint">Recommended: 400x300px • Max 1MB</div>
                                    </label>
                                </div>
                                <div class="image-preview-container hidden" id="thumbnailImagePreview">
                                    <img class="image-preview" id="thumbnailPreviewImg" src=""
                                        alt="Thumbnail Preview">
                                    <button type="button" class="remove-image" id="removeThumbnailImage">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @if ($errors->has('thumbnail_image'))
                                    <div class="invalid-feedback">{{ $errors->first('thumbnail_image') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- SEO --}}
                    <div class="form-section p-6">
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
                                <input type="text" id="meta_title" name="meta_title"
                                    value="{{ old('meta_title', $news->meta_title) }}" class="form-input"
                                    placeholder="SEO title for search engines" maxlength="60">
                                <p class="text-xs text-gray-500 mt-1">
                                    Recommended: 50-60 characters
                                </p>
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="form-label">Meta Description</label>
                                    <span class="text-xs text-gray-500" id="metaDescCounter">0/160</span>
                                </div>
                                <textarea id="meta_description" name="meta_description" rows="3" class="form-input"
                                    placeholder="Brief description for search results" maxlength="160">{{ old('meta_description', $news->meta_description) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">
                                    Recommended: 120-160 characters
                                </p>
                            </div>

                            <div>
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    value="{{ old('meta_keywords', $news->meta_keywords) }}" class="form-input"
                                    placeholder="keyword1, keyword2, keyword3">
                                <p class="text-xs text-gray-500 mt-2">
                                    Separate keywords with commas (Max 255 characters)
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- PUBLISH --}}
                    <div class="form-section p-6">
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
                                <label class="form-label mb-4 block required-field">Status</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="status" value="draft"
                                            {{ old('status', $news->status) == 'draft' ? 'checked' : '' }} class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-edit text-gray-500"></i>
                                            Draft
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="published"
                                            {{ old('status', $news->status) == 'published' ? 'checked' : '' }}
                                            class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-gray-500"></i>
                                            Publish
                                        </span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="status" value="archived"
                                            {{ old('status', $news->status) == 'archived' ? 'checked' : '' }}
                                            class="hidden">
                                        <span class="radio-custom"></span>
                                        <span class="flex items-center gap-3">
                                            <i class="fas fa-archive text-gray-500"></i>
                                            Archive
                                        </span>
                                    </label>
                                </div>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                @endif
                            </div>

                            <div>
                                <label class="form-label">Publish Date & Time</label>
                                <div class="relative">
                                    <input type="text" id="published_at" name="published_at"
                                        class="form-input flatpickr-input pl-11" placeholder="Select date and time"
                                        value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i')) }}">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <button type="button" id="clearDate"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 bg-transparent border-none cursor-pointer">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    Leave empty to use current date and time when publishing
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="sticky-submit py-6 flex justify-between items-center mt-8">
                        <div class="flex items-center gap-4">
                            <div id="formStatus" class="status-badge status-{{ $news->status }}">
                                <i
                                    class="fas {{ $news->status == 'published' ? 'fa-check-circle' : ($news->status == 'archived' ? 'fa-archive' : 'fa-edit') }}"></i>
                                <span id="statusText">{{ ucfirst($news->status) }}</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <span id="formProgress">0%</span> complete
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.news.index') }}"
                                class="px-6 py-3 rounded-xl font-semibold shadow transition-all duration-300 flex items-center gap-3
                                       bg-gray-100 text-gray-700 hover:bg-gray-200 border border-gray-300">
                                <i class="fas fa-times"></i>
                                Cancel
                            </a>
                            <button type="submit" id="submitBtn"
                                class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 
                                       text-white px-10 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl 
                                       transition-all duration-300 flex items-center gap-3">
                                <i class="fas fa-save"></i>
                                Update Article
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            {{-- ================= RIGHT PREVIEW ================= --}}
            <div class="lg:w-[30%]">
                <div class="sticky top-8 space-y-8">

                    {{-- PREVIEW CARD --}}
                    <div class="preview-card">
                        <div class="seo-preview relative">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="text-xs opacity-75 mb-1">{{ config('app.url', 'example.com') }}</div>
                            <p id="previewMetaTitle" class="text-lg font-semibold truncate">
                                {{ old('meta_title', $news->meta_title) ?: 'Your SEO Title Here' }}
                            </p>
                            <p id="previewMetaUrl" class="text-sm opacity-90 truncate">
                                {{ url('/news') }}/{{ old('slug', $news->slug) ?: 'your-article-title' }}
                            </p>
                            <p id="previewMetaDesc" class="text-sm mt-2 opacity-90 line-clamp-2">
                                {{ old('meta_description', $news->meta_description) ?: 'This is where your meta description will appear in search results.' }}
                            </p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-start">
                                <div class="preview-badge" id="previewCategory">
                                    <i class="fas fa-tag mr-2"></i>
                                    {{ $news->category->name ?? 'Uncategorized' }}
                                </div>
                                <div class="status-badge status-{{ old('status', $news->status) }}" id="previewStatus">
                                    <i
                                        class="fas {{ old('status', $news->status) == 'published' ? 'fa-check-circle' : (old('status', $news->status) == 'archived' ? 'fa-archive' : 'fa-edit') }}"></i>
                                    {{ ucfirst(old('status', $news->status)) }}
                                </div>
                            </div>

                            {{-- Featured Image Preview --}}
                            {{-- Featured Image Preview --}}
                            <div id="previewFeaturedImageContainer">
                                <img id="previewFeaturedImage" src="{{ $news->featured_image_url }}"
                                    class="w-full rounded-xl preview-image shadow"
                                    onerror="this.src='https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80'">
                            </div>

                            {{-- Thumbnail Image Preview --}}
                            <div class="mt-4">
                                <label class="text-sm font-medium text-gray-700 mb-2 block">Thumbnail Preview:</label>
                                <div id="previewThumbnailContainer" class="flex flex-wrap gap-2">
                                    <div class="thumbnail-item">
                                        <img id="previewThumbnailImg" src="{{ $news->thumbnail_url }}"
                                            alt="Thumbnail Preview"
                                            onerror="this.src='https://via.placeholder.com/80x80/cccccc/969696?text=Thumbnail'">
                                    </div>
                                </div>
                            </div>

                            <h3 id="previewTitle" class="text-xl font-bold text-gray-800 preview-title mt-4">
                                {{ old('title', $news->title) ?: 'Your article title will appear here' }}
                            </h3>

                            <p id="previewExcerpt" class="text-gray-600 preview-excerpt">
                                {{ old('excerpt', $news->excerpt) ?: 'This is where your article excerpt will show. Write a compelling summary to engage readers.' }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-sm">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700" id="previewAuthor">
                                            {{ old('author', $news->author ?? auth()->user()->name) }}
                                        </p>
                                        <p class="text-xs text-gray-500" id="previewDate">
                                            @if (old('published_at', $news->published_at))
                                                {{ \Carbon\Carbon::parse(old('published_at', $news->published_at))->format('M d, Y H:i') }}
                                            @else
                                                {{ now()->format('M d, Y') }}
                                            @endif
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
                                        <span id="featuredImageStatus"
                                            class="{{ $news->featured_image ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $news->featured_image ? 'Yes' : 'No' }}
                                        </span> /
                                        <span id="thumbnailImageStatus"
                                            class="{{ $news->thumbnail_image ? 'text-green-600' : 'text-red-600' }}">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi untuk update hidden input dari Summernote
            function updateContentInput() {
                const content = $('#summernote').summernote('code');
                $('#content_hidden').val(content);

                // Update preview content length
                updateContentLength(content);
                updateSEOscore();
            }

            // Initialize Summernote
            $('#summernote').summernote({
                height: 350,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function() {
                        updateContentInput();
                    },
                    onInit: function() {
                        // Set initial content dari database
                        const initialContent = `{!! addslashes(old('content', $news->content)) !!}`;
                        $('#summernote').summernote('code', initialContent);
                    }
                }
            });

            // Initialize Flatpickr
            const datepicker = flatpickr('#published_at', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                defaultDate: "{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i')) }}",
                minDate: "{{ now()->subYears(1)->format('Y-m-d') }}",
                maxDate: "{{ now()->addYears(5)->format('Y-m-d') }}",
                allowInput: true,
                clickOpens: true,
                onChange: function(selectedDates, dateStr) {
                    updatePreviewDate(dateStr);
                }
            });

            // Clear date button
            $('#clearDate').click(function() {
                datepicker.clear();
                $('#published_at').val('');
                $('#previewDate').text('{{ now()->format('M d, Y') }}');
            });

            // Fungsi generate slug
            function generateSlug(title) {
                if (!title) return '';

                return title
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }

            // Auto-generate slug from title
            $('#title').on('input', function() {
                const title = $(this).val();
                const slug = generateSlug(title);

                if (!isSlugEditable) {
                    $('#slug').val(slug);
                    $('#slugPreview').text(slug || 'your-title');
                    $('#previewMetaUrl').text('{{ config('app.url', 'example.com') }}/news/' + (slug ||
                        'your-title'));
                }

                $('#previewTitle').text(title || 'Your article title will appear here');
                updateSEOscore();
            });

            // Enable/disable slug editing
            let isSlugEditable = false;
            $('#editSlug').click(function() {
                isSlugEditable = !isSlugEditable;
                const slugInput = $('#slug');
                if (isSlugEditable) {
                    slugInput.prop('readonly', false);
                    slugInput.removeClass('bg-gray-100');
                    slugInput.addClass('bg-white border-blue-300');
                    $(this).html('<i class="fas fa-lock text-green-600"></i>');
                } else {
                    slugInput.prop('readonly', true);
                    slugInput.removeClass('bg-white border-blue-300');
                    slugInput.addClass('bg-gray-100');
                    $(this).html('<i class="fas fa-edit text-blue-600"></i>');
                }
            });

            // Update slug preview when manually edited
            $('#slug').on('input', function() {
                const slug = $(this).val();
                $('#slugPreview').text(slug || 'your-title');
                $('#previewMetaUrl').text('{{ url('/news') }}/' + (slug || 'your-title'));
            });

            // Character counters
            function setupCounter(elementId, maxLength, previewElementId = null) {
                const element = $(elementId);
                const counter = $(elementId + 'Counter');
                const progress = $(elementId + 'Progress');

                element.on('input', function() {
                    const length = $(this).val().length;
                    counter.text(`${length}/${maxLength}`);

                    // Update progress bar
                    if (progress.length) {
                        const percentage = (length / maxLength) * 100;
                        progress.css('width', Math.min(percentage, 100) + '%');

                        // Update color based on length
                        if (length > maxLength * 0.9) {
                            progress.css('background', '#EF4444');
                        } else if (length > maxLength * 0.7) {
                            progress.css('background', '#F59E0B');
                        } else {
                            progress.css('background', 'linear-gradient(90deg, #4f46e5, #8B5CF6)');
                        }
                    }

                    // Update preview
                    if (previewElementId) {
                        $(previewElementId).text($(this).val() || $(previewElementId).data('default'));
                    }

                    updateSEOscore();
                });

                // Initial count
                const initialValue = element.val();
                const initialLength = initialValue ? initialValue.length : 0;
                counter.text(`${initialLength}/${maxLength}`);

                if (progress.length) {
                    const percentage = (initialLength / maxLength) * 100;
                    progress.css('width', Math.min(percentage, 100) + '%');

                    if (initialLength > maxLength * 0.9) {
                        progress.css('background', '#EF4444');
                    } else if (initialLength > maxLength * 0.7) {
                        progress.css('background', '#F59E0B');
                    } else {
                        progress.css('background', 'linear-gradient(90deg, #4f46e5, #8B5CF6)');
                    }
                }
            }

            // Initialize counters
            setupCounter('#title', 120, '#previewTitle');
            setupCounter('#excerpt', 200, '#previewExcerpt');
            setupCounter('#meta_title', 60, '#previewMetaTitle');
            setupCounter('#meta_description', 160, '#previewMetaDesc');

            // Update other previews
            $('#excerpt').on('input', function() {
                $('#previewExcerpt').text($(this).val() ||
                    'This is where your article excerpt will show. Write a compelling summary to engage readers.'
                );
            });

            $('#author').on('input', function() {
                $('#previewAuthor').text($(this).val() || '{{ auth()->user()->name ?? 'Admin' }}');
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
                $('#previewCategory').html('<i class="fas fa-tag mr-2"></i>' +
                    (selectedText !== '-- Select Category --' ? selectedText : 'Uncategorized'));
            });

            // Status radio buttons
            $('input[name="status"]').change(function() {
                const status = $(this).val();
                const statusBadge = $('#previewStatus');
                const formStatus = $('#formStatus');
                const statusText = $('#statusText');

                statusBadge.removeClass().addClass('status-badge');
                formStatus.removeClass().addClass('status-badge');

                if (status === 'published') {
                    statusBadge.addClass('status-published').html(
                        '<i class="fas fa-check-circle"></i> Published');
                    formStatus.addClass('status-published').html(
                        '<i class="fas fa-check-circle"></i> Published');
                    statusText.text('Published');
                } else if (status === 'archived') {
                    statusBadge.addClass('status-archived').html('<i class="fas fa-archive"></i> Archived');
                    formStatus.addClass('status-archived').html('<i class="fas fa-archive"></i> Archived');
                    statusText.text('Archived');
                } else {
                    statusBadge.addClass('status-draft').html('<i class="fas fa-edit"></i> Draft');
                    formStatus.addClass('status-draft').html('<i class="fas fa-edit"></i> Draft');
                    statusText.text('Draft');
                }
            });

            // File upload with drag and drop
            function setupFileUpload(inputId, containerId, previewId, imageId, statusId) {
                const input = $(inputId);
                const container = $(containerId);
                const preview = $(previewId);
                const image = $(imageId);
                const status = $(statusId);

                // Click to upload
                container.on('click', function(e) {
                    if (e.target.tagName !== 'INPUT') {
                        input.click();
                    }
                });

                // File selection
                input.on('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];

                        // Check file size
                        const maxSize = inputId === '#featured_image' ? 2 * 1024 * 1024 : 1 * 1024 * 1024;
                        if (file.size > maxSize) {
                            alert(`File size exceeds maximum limit (${maxSize/1024/1024}MB)`);
                            this.value = '';
                            return;
                        }

                        // Check file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif',
                            'image/webp'
                        ];
                        if (!validTypes.includes(file.type)) {
                            alert('Please upload a valid image file (JPEG, PNG, JPG, GIF, WEBP)');
                            this.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.removeClass('hidden');
                            image.attr('src', e.target.result);
                            container.addClass('hidden');
                            status.removeClass('text-red-600').addClass('text-green-600').text('Yes');

                            // Update preview in preview card
                            if (inputId === '#featured_image') {
                                $('#previewFeaturedImage').attr('src', e.target.result);
                            } else {
                                $('#previewThumbnailImg').attr('src', e.target.result);
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Drag and drop
                container.on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    container.addClass('drag-over');
                });

                container.on('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    container.removeClass('drag-over');
                });

                container.on('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    container.removeClass('drag-over');

                    const files = e.originalEvent.dataTransfer.files;
                    if (files.length > 0) {
                        input[0].files = files;
                        input.trigger('change');
                    }
                });
            }

            // Setup file uploads
            setupFileUpload('#featured_image', '#featuredImageContainer', '#featuredImagePreview',
                '#featuredPreviewImg', '#featuredImageStatus');
            setupFileUpload('#thumbnail_image', '#thumbnailImageContainer', '#thumbnailImagePreview',
                '#thumbnailPreviewImg', '#thumbnailImageStatus');

            // Remove images
            $('#removeFeaturedImage').click(function() {
                $('#featured_image').val('');
                $('#featuredImagePreview').addClass('hidden');
                $('#featuredImageContainer').removeClass('hidden');
                $('#featuredImageStatus').removeClass('text-green-600').addClass('text-red-600').text('No');
                $('#previewFeaturedImage').attr('src',
                    'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=200&q=80'
                );
            });

            $('#removeThumbnailImage').click(function() {
                $('#thumbnail_image').val('');
                $('#thumbnailImagePreview').addClass('hidden');
                $('#thumbnailImageContainer').removeClass('hidden');
                $('#thumbnailImageStatus').removeClass('text-green-600').addClass('text-red-600').text(
                    'No');
                $('#previewThumbnailImg').attr('src',
                    'https://via.placeholder.com/80x80/cccccc/969696?text=Thumbnail');
            });

            // Calculate content length
            function updateContentLength(content) {
                // Remove HTML tags untuk menghitung kata
                const text = $(content).text();
                const wordCount = text.trim().split(/\s+/).filter(word => word.length > 0).length;
                const charCount = text.length;

                $('#contentLength').text(wordCount + ' words');

                // Calculate read time (average 200 words per minute)
                const readTime = Math.max(1, Math.ceil(wordCount / 200));
                $('#previewReadTime').text(readTime + ' min read');

                updateSEOscore();
            }

            // Update preview date
            function updatePreviewDate(dateStr) {
                if (dateStr) {
                    const date = new Date(dateStr);
                    const formattedDate = date.toLocaleDateString('en-US', {
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
                const contentText = $('#summernote').summernote('code');
                const wordCount = $(contentText).text().trim().split(/\s+/).filter(word => word.length > 0).length;
                if (wordCount >= 300) score += 30;
                else if (wordCount >= 200) score += 20;
                else if (wordCount >= 100) score += 10;

                // Update score display
                const finalScore = Math.min(score, maxScore);
                $('#seoScore').text(finalScore + '%');

                if (finalScore >= 80) {
                    $('#seoScore').removeClass('text-red-600 text-yellow-600').addClass('text-green-600');
                } else if (finalScore >= 60) {
                    $('#seoScore').removeClass('text-red-600 text-green-600').addClass('text-yellow-600');
                } else {
                    $('#seoScore').removeClass('text-green-600 text-yellow-600').addClass('text-red-600');
                }

                // Update form progress
                $('#formProgress').text(finalScore + '%');
            }

            // Form submission - Pastikan content diupdate sebelum submit
            $('#articleForm').on('submit', function(e) {
                // Update content dari Summernote ke hidden input
                updateContentInput();

                // Validasi content
                const content = $('#content_hidden').val();
                if (!content || content.trim() === '' || content === '<p><br></p>') {
                    e.preventDefault();
                    alert('Please enter some content for the article.');
                    $('#submitBtn').prop('disabled', false);
                    return false;
                }

                // Validasi required fields
                const title = $('#title').val();
                const slug = $('#slug').val();

                if (!title || !slug) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    $('#submitBtn').prop('disabled', false);
                    return false;
                }

                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                submitBtn.addClass('btn-loading');
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Updating...');

                // Biarkan form submit normal
                return true;
            });

            // Handle Enter key in form (prevent accidental submission)
            $('#articleForm').on('keydown', function(e) {
                if (e.key === 'Enter' && $(e.target).is(
                        'input:not([type="submit"]):not([type="button"])')) {
                    e.preventDefault();
                }
            });

            // Handle remove image checkboxes
            $('input[name="remove_featured_image"], input[name="remove_thumbnail_image"]').change(function() {
                if ($(this).is(':checked')) {
                    const imageType = $(this).attr('name').includes('featured') ? 'featured' : 'thumbnail';
                    const message = `This will remove the current ${imageType} image. Are you sure?`;

                    if (!confirm(message)) {
                        $(this).prop('checked', false);
                    }
                }
            });

            // Initial updates
            updateContentInput();
            updateSEOscore();

            // Trigger initial updates for preview
            $('#title').trigger('input');
            $('#slug').trigger('input');
            $('input[name="status"]:checked').trigger('change');

            // Set initial SEO score based on current content
            setTimeout(() => {
                updateContentLength($('#summernote').summernote('code'));
            }, 500);
        });
    </script>
@endpush
