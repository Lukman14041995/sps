@extends('admin.layouts.app')

@section('title', 'CSR Management')
@section('subtitle', 'Manage Corporate Social Responsibility Programs')

@push('styles')
    <style>
        .csr-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            height: 100%;
        }

        .csr-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .csr-image {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .csr-card:hover .csr-image {
            transform: scale(1.05);
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }

        .progress-bar {
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
            background-color: #e5e7eb;
        }

        .progress-fill {
            height: 100%;
            transition: width 0.3s ease;
        }

        /* Modal Styles */
        .modal-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
        }

        .modal-container.active {
            transform: translateX(0);
        }

        /* Line clamp utilities */
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        /* Stats card hover */
        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        /* Filter styles */
        .filter-btn.active {
            background-color: #3b82f6;
            color: white;
        }

        /* Animation for new program */
        .new-program-highlight {
            animation: highlightPulse 2s ease-in-out;
        }

        @keyframes highlightPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0.1);
            }
        }

        /* Status colors */
        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-archived {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        /* Form step styles */
        .form-step {
            transition: all 0.3s ease;
        }

        .form-step.active {
            display: block;
        }

        .form-step:not(.active) {
            display: none;
        }

        /* Gallery preview */
        .gallery-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .gallery-preview-item {
            position: relative;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .gallery-preview-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .gallery-preview-item button {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            width: 1.5rem;
            height: 1.5rem;
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        /* Impact metrics */
        .impact-metric-item {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        /* Team members */
        .team-member-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">CSR Programs</h1>
                    <p class="text-gray-600 mt-2">Manage your Corporate Social Responsibility initiatives</p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Filter Dropdown -->
                    <div class="relative">
                        <button id="filterDropdown"
                            class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 rounded-xl font-medium transition duration-200 shadow-sm hover:shadow">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span id="filterText">Filter</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="filterMenu"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-10 hidden">
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="all">All Programs</a>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="published">Published</a>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="draft">Draft</a>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="archived">Archived</a>
                            <div class="border-t border-gray-200 my-2"></div>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="category-social">Social Programs</a>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="category-environment">Environment Programs</a>
                            <a href="#" class="filter-option block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-filter="category-quality">Quality Programs</a>
                        </div>
                    </div>

                    <!-- Create CSR Button with Modal Trigger -->
                    <button id="openCreateModal"
                        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-semibold transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create CSR Program
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Programs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg border border-gray-200 p-6 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Programs</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
                        <p class="text-xs text-blue-600 mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            All CSR Initiatives
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Published Programs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg border border-gray-200 p-6 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Published</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">{{ $stats['published'] }}</p>
                        <div class="mt-3">
                            <div class="flex items-center justify-between text-xs text-gray-600 mb-1">
                                <span>Active</span>
                                <span>{{ $stats['total'] > 0 ? round(($stats['published'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill bg-green-500"
                                    style="width: {{ $stats['total'] > 0 ? ($stats['published'] / $stats['total']) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Beneficiaries -->
            <div class="stats-card bg-white rounded-2xl shadow-lg border border-gray-200 p-6 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Beneficiaries</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">{{ number_format($stats['total_beneficiaries']) }}
                        </p>
                        <p class="text-xs text-purple-600 mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Lives Impacted
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Investment -->
            <div class="stats-card bg-white rounded-2xl shadow-lg border border-gray-200 p-6 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Investment</p>
                        <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($stats['total_budget']) }}</p>
                        <p class="text-xs text-yellow-600 mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Social Value Created
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats by Category -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Programs by Category</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($categories as $key => $category)
                    @php
                        // Tentukan warna berdasarkan kategori
                        $colorMap = [
                            'social' => '#3B82F6',
                            'environment' => '#10B981',
                            'quality' => '#F59E0B',
                        ];
                        $color = $category['color'] ?? ($colorMap[$key] ?? '#6B7280');
                        $lightColor = str_replace('#', '', $color) . '08';
                    @endphp
                    <div class="flex items-center justify-between p-4 rounded-xl transition duration-200 hover:shadow-md"
                        style="background-color: #{{ $lightColor }}; border-left: 4px solid {{ $color }}">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3"
                                style="background-color: {{ $color }}20;">
                                <span class="text-lg">{{ $category['icon'] ?? '📊' }}</span>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $category['name'] ?? ucfirst($key) }}</h3>
                                <p class="text-sm text-gray-600">{{ $stats['by_category'][$key] ?? 0 }} Programs</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold" style="color: {{ $color }}">
                            {{ $stats['by_category'][$key] ?? 0 }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CSR Programs Grid -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">CSR Programs</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $csrPrograms->total() }} programs found</p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" placeholder="Search programs..."
                            class="pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 w-64"
                            id="searchInput">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <select id="sortSelect"
                            class="appearance-none pl-4 pr-10 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 bg-white">
                            <option value="latest">Sort by: Latest</option>
                            <option value="title_asc">Sort by: Title A-Z</option>
                            <option value="title_desc">Sort by: Title Z-A</option>
                            <option value="budget_desc">Sort by: Budget (High to Low)</option>
                            <option value="budget_asc">Sort by: Budget (Low to High)</option>
                            <option value="beneficiaries_desc">Sort by: Beneficiaries</option>
                            <option value="year_desc">Sort by: Year (Newest)</option>
                            <option value="year_asc">Sort by: Year (Oldest)</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if ($csrPrograms->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-12 text-center">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-green-50 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No CSR Programs Found</h3>
                    <p class="text-gray-600 mb-6">Start documenting your corporate social responsibility initiatives</p>
                    <button id="openCreateModalEmpty"
                        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-semibold transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Your First CSR Program
                    </button>
                </div>
            @else
                <!-- Programs Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="csrGrid">
                    @foreach ($csrPrograms as $csr)
                        <div class="csr-card bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden"
                            data-status="{{ $csr->status }}" data-category="{{ $csr->category }}"
                            data-csr-id="{{ $csr->id }}" data-title="{{ strtolower($csr->title) }}"
                            data-budget="{{ $csr->budget }}" data-beneficiaries="{{ $csr->beneficiaries_count }}"
                            data-year="{{ $csr->year }}" data-created="{{ $csr->created_at }}">
                            <!-- Image -->
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::disk('s3')->url($csr->featured_image) }}"
                                    alt="{{ $csr->title }}" class="w-full h-48 csr-image" />

                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    @php
                                        // Map status to display names
                                        $statusDisplay = [
                                            'published' => 'Published',
                                            'draft' => 'Draft',
                                            'archived' => 'Archived',
                                        ];
                                        $statusColors = [
                                            'published' => 'status-published',
                                            'draft' => 'status-draft',
                                            'archived' => 'status-archived',
                                        ];
                                    @endphp
                                    <span
                                        class="status-badge {{ $statusColors[$csr->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusDisplay[$csr->status] ?? ucfirst($csr->status) }}
                                    </span>
                                </div>
                                <!-- Category Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="status-badge"
                                        style="background-color: {{ $csr->category_color }}20; color: {{ $csr->category_color }}">
                                        {{ $csr->category_name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $csr->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $csr->excerpt ?? Str::limit(strip_tags($csr->content), 120) }}
                                </p>

                                <!-- Stats -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Beneficiaries</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $csr->formatted_beneficiaries }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Budget</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $csr->formatted_budget }}</p>
                                    </div>
                                </div>

                                <!-- Location & Year -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                    @if ($csr->location)
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $csr->location }}
                                        </span>
                                    @endif
                                    @if ($csr->year)
                                        <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $csr->year }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Duration -->
                                @if ($csr->duration)
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Duration: {{ $csr->duration }}
                                    </div>
                                @endif

                            </div>

                            <!-- Actions -->
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('admin.csr.show', $csr) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-200 flex items-center">
                                        View Details
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.csr.edit', $csr) }}"
                                            class="p-2 text-gray-400 hover:text-blue-600 transition duration-200 hover:bg-blue-50 rounded-lg"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.csr.destroy', $csr) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-600 transition duration-200 hover:bg-red-50 rounded-lg"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this CSR program?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($csrPrograms->hasPages())
                    <div class="mt-8">
                        {{ $csrPrograms->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Create CSR Modal -->
    <div id="createCsrModal"
        class="modal-overlay fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-end">
        <div class="modal-container w-full max-w-4xl h-full bg-white overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 z-10 bg-white border-b border-gray-200 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Create New CSR Program</h2>
                        <p class="text-gray-600 mt-1">Document your corporate social responsibility initiative</p>
                    </div>
                    <button id="closeCreateModal" class="p-2 hover:bg-gray-100 rounded-lg transition duration-200">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <form id="createCsrForm" action="{{ route('admin.csr.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Progress Steps -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold">1</span>
                                </div>
                                <span class="ml-2 font-medium text-blue-600">Basic Info</span>
                            </div>
                            <div class="h-1 w-12 bg-gray-300"></div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-semibold">2</span>
                                </div>
                                <span class="ml-2 font-medium text-gray-500">Details</span>
                            </div>
                            <div class="h-1 w-12 bg-gray-300"></div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-semibold">3</span>
                                </div>
                                <span class="ml-2 font-medium text-gray-500">Media & Results</span>
                            </div>
                            <div class="h-1 w-12 bg-gray-300"></div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-gray-600 font-semibold">4</span>
                                </div>
                                <span class="ml-2 font-medium text-gray-500">Publish</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="form-step active">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Program Title *
                                </label>
                                <input type="text" name="title" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Enter program title">
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Category *
                                </label>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($categories as $key => $category)
                                        <label class="relative">
                                            <input type="radio" name="category" value="{{ $key }}"
                                                class="sr-only peer" {{ $loop->first ? 'checked' : '' }}>
                                            <div
                                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-2"
                                                    style="background-color: {{ $category['color'] }}20">
                                                    @if ($key == 'social')
                                                        <svg class="w-5 h-5" style="color: {{ $category['color'] }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    @elseif($key == 'environment')
                                                        <svg class="w-5 h-5" style="color: {{ $category['color'] }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4 4 0 003 15z" />
                                                        </svg>
                                                    @elseif($key == 'quality')
                                                        <svg class="w-5 h-5" style="color: {{ $category['color'] }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-medium">{{ $category['name'] }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Short Description
                                </label>
                                <textarea name="excerpt" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                    placeholder="Brief summary of the program"></textarea>
                            </div>

                            <!-- Content -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Program Description *
                                </label>
                                <textarea name="content" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                    placeholder="Detailed description of the program, objectives, and impact"></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="button" onclick="nextStep(2)"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-200">
                                Next: Program Details →
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Program Details -->
                    <div id="step2" class="form-step">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Program Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Location
                                </label>
                                <input type="text" name="location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="City, Region">
                            </div>

                            <!-- Year -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Year
                                </label>
                                <select name="year"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                                    <option value="">Select Year</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Duration -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Duration
                                </label>
                                <input type="text" name="duration"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="e.g., 6 months, 1 year">
                            </div>

                            <!-- Beneficiaries -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Beneficiaries Count
                                </label>
                                <input type="number" name="beneficiaries_count" min="0"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Number of people impacted">
                            </div>

                            <!-- Budget -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget (in Rupiah)
                                </label>
                                <input type="number" name="budget" min="0" step="100000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Total program budget">
                            </div>

                            <!-- Partners -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Partners
                                </label>
                                <input type="text" name="partners"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Organization names separated by comma">
                            </div>
                        </div>

                        <div class="flex justify-between mt-8">
                            <button type="button" onclick="prevStep(1)"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                ← Back
                            </button>
                            <button type="button" onclick="nextStep(3)"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-200">
                                Next: Media & Results →
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Media & Results -->
                    <div id="step3" class="form-step">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Media & Results</h3>

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Featured Image
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition duration-200"
                                id="featuredImageContainer">
                                <div class="mb-4">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium mb-2" id="featuredImageText">Upload featured image</p>
                                <p class="text-sm text-gray-500 mb-4" id="featuredImageInfo">Recommended: 1200x630px •
                                    Max: 2MB</p>
                                <div id="featuredImagePreview" class="mb-4"></div>
                                <input type="file" name="featured_image" accept="image/*" class="hidden"
                                    id="featuredImageInput">
                                <button type="button" onclick="document.getElementById('featuredImageInput').click()"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition duration-200">
                                    Choose File
                                </button>
                            </div>
                        </div>

                        <!-- Gallery Images -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gallery Images
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition duration-200">
                                <div class="mb-4">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium mb-2">Upload gallery images</p>
                                <p class="text-sm text-gray-500 mb-4">Multiple images allowed • Max 10 images</p>
                                <div id="galleryPreview" class="gallery-preview mb-4"></div>
                                <input type="file" name="gallery_images[]" accept="image/*" multiple class="hidden"
                                    id="galleryImagesInput">
                                <button type="button" onclick="document.getElementById('galleryImagesInput').click()"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition duration-200">
                                    Choose Files
                                </button>
                            </div>
                        </div>

                        <!-- Achievements -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Key Achievements
                            </label>
                            <textarea name="achievements" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                placeholder="Notable accomplishments and outcomes"></textarea>
                        </div>

                        <!-- Testimonials -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Testimonials
                            </label>
                            <textarea name="testimonials" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                placeholder="Quotes or feedback from beneficiaries"></textarea>
                        </div>

                        <!-- Impact Metrics -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Impact Metrics (Optional)
                            </label>
                            <div id="impactMetricsContainer" class="space-y-3">
                                <div class="impact-metric-item">
                                    <input type="text" name="impact_metrics[0][name]" placeholder="Metric name"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <input type="text" name="impact_metrics[0][value]" placeholder="Value"
                                        class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <input type="text" name="impact_metrics[0][unit]" placeholder="Unit"
                                        class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="addImpactMetric()"
                                        class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Team Members -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Team Members (Optional)
                            </label>
                            <div id="teamMembersContainer" class="space-y-3">
                                <div class="team-member-item">
                                    <input type="text" name="team_members[0][name]" placeholder="Name"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <input type="text" name="team_members[0][role]" placeholder="Role"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="addTeamMember()"
                                        class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-8">
                            <button type="button" onclick="prevStep(2)"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                ← Back
                            </button>
                            <button type="button" onclick="nextStep(4)"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-200">
                                Next: Publish →
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Publishing -->
                    <div id="step4" class="form-step">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Publishing Options</h3>

                        <!-- Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="relative">
                                    <input type="radio" name="status" value="draft" checked class="sr-only peer">
                                    <div
                                        class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-yellow-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50">
                                        <svg class="w-6 h-6 text-gray-400 peer-checked:text-yellow-500 mb-2"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="text-sm font-medium peer-checked:text-yellow-700">Draft</span>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="status" value="published" class="sr-only peer">
                                    <div
                                        class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-green-300 peer-checked:border-green-500 peer-checked:bg-green-50">
                                        <svg class="w-6 h-6 text-gray-400 peer-checked:text-green-500 mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-sm font-medium peer-checked:text-green-700">Publish</span>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="status" value="archived" class="sr-only peer">
                                    <div
                                        class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                        <svg class="w-6 h-6 text-gray-400 peer-checked:text-blue-500 mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        <span class="text-sm font-medium peer-checked:text-blue-700">Archive</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- SEO Fields -->
                        <div class="space-y-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Title
                                </label>
                                <input type="text" name="meta_title"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="SEO title for search engines">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Description
                                </label>
                                <textarea name="meta_description" rows="2"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                    placeholder="Brief description for search results"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Meta Keywords
                                </label>
                                <input type="text" name="meta_keywords"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Keywords separated by comma">
                            </div>
                        </div>

                        <div class="flex justify-between mt-8">
                            <button type="button" onclick="prevStep(3)"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                ← Back
                            </button>
                            <div class="flex gap-3">
                                <button type="button" id="saveAsDraftBtn"
                                    class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-medium transition duration-200">
                                    Save as Draft
                                </button>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-200 shadow-md hover:shadow-lg">
                                    Create Program
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Modal functionality
        const modal = document.getElementById('createCsrModal');
        const openModalBtn = document.getElementById('openCreateModal');
        const openModalEmptyBtn = document.getElementById('openCreateModalEmpty');
        const closeModalBtn = document.getElementById('closeCreateModal');
        const csrForm = document.getElementById('createCsrForm');
        const filterDropdown = document.getElementById('filterDropdown');
        const filterMenu = document.getElementById('filterMenu');
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const csrGrid = document.getElementById('csrGrid');
        const filterText = document.getElementById('filterText');

        // Open modal
        if (openModalBtn) {
            openModalBtn.addEventListener('click', () => {
                modal.classList.add('active');
                document.querySelector('.modal-container').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (openModalEmptyBtn) {
            openModalEmptyBtn.addEventListener('click', () => {
                modal.classList.add('active');
                document.querySelector('.modal-container').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        // Close modal
        const closeModal = () => {
            modal.classList.remove('active');
            document.querySelector('.modal-container').classList.remove('active');
            document.body.style.overflow = 'auto';
            // Reset form steps
            document.querySelectorAll('.form-step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById('step1').classList.add('active');
            // Reset form
            csrForm.reset();
            // Clear previews
            document.getElementById('featuredImagePreview').innerHTML = '';
            document.getElementById('galleryPreview').innerHTML = '';
            document.getElementById('featuredImageText').textContent = 'Upload featured image';
            document.getElementById('featuredImageInfo').textContent = 'Recommended: 1200x630px • Max: 2MB';
        };

        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Filter dropdown toggle
        if (filterDropdown && filterMenu) {
            filterDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
                filterMenu.classList.toggle('hidden');
            });

            // Close filter when clicking outside
            document.addEventListener('click', (e) => {
                if (!filterDropdown.contains(e.target) && !filterMenu.contains(e.target)) {
                    filterMenu.classList.add('hidden');
                }
            });

            // Filter functionality
            document.querySelectorAll('.filter-option').forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    const filter = option.getAttribute('data-filter');

                    // Update button text
                    filterText.textContent = option.textContent;

                    // Filter logic
                    filterCsrPrograms(filter);

                    // Close dropdown
                    filterMenu.classList.add('hidden');
                });
            });
        }

        // Search functionality
        if (searchInput && csrGrid) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const cards = csrGrid.querySelectorAll('.csr-card');

                cards.forEach(card => {
                    const title = card.getAttribute('data-title');
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const location = card.querySelector('span:last-child')?.textContent?.toLowerCase() ||
                        '';

                    if (title.includes(searchTerm) || description.includes(searchTerm) || location.includes(
                            searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Sort functionality
        if (sortSelect && csrGrid) {
            sortSelect.addEventListener('change', (e) => {
                const sortBy = e.target.value;
                sortCsrPrograms(sortBy);
            });
        }

        // Sort CSR programs
        function sortCsrPrograms(sortBy) {
            const cards = Array.from(csrGrid.querySelectorAll('.csr-card'));

            cards.sort((a, b) => {
                switch (sortBy) {
                    case 'latest':
                        return new Date(b.getAttribute('data-created')) - new Date(a.getAttribute('data-created'));
                    case 'title_asc':
                        return a.getAttribute('data-title').localeCompare(b.getAttribute('data-title'));
                    case 'title_desc':
                        return b.getAttribute('data-title').localeCompare(a.getAttribute('data-title'));
                    case 'budget_desc':
                        return parseFloat(b.getAttribute('data-budget')) - parseFloat(a.getAttribute(
                            'data-budget'));
                    case 'budget_asc':
                        return parseFloat(a.getAttribute('data-budget')) - parseFloat(b.getAttribute(
                            'data-budget'));
                    case 'beneficiaries_desc':
                        return parseFloat(b.getAttribute('data-beneficiaries')) - parseFloat(a.getAttribute(
                            'data-beneficiaries'));
                    case 'year_desc':
                        return parseFloat(b.getAttribute('data-year')) - parseFloat(a.getAttribute('data-year'));
                    case 'year_asc':
                        return parseFloat(a.getAttribute('data-year')) - parseFloat(b.getAttribute('data-year'));
                    default:
                        return 0;
                }
            });

            // Reorder cards in grid
            cards.forEach(card => csrGrid.appendChild(card));
        }

        // Filter CSR programs
        function filterCsrPrograms(filterType) {
            const cards = csrGrid.querySelectorAll('.csr-card');

            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const category = card.getAttribute('data-category');

                switch (filterType) {
                    case 'all':
                        card.style.display = 'block';
                        break;
                    case 'published':
                        card.style.display = status === 'published' ? 'block' : 'none';
                        break;
                    case 'draft':
                        card.style.display = status === 'draft' ? 'block' : 'none';
                        break;
                    case 'archived':
                        card.style.display = status === 'archived' ? 'block' : 'none';
                        break;
                    case 'category-social':
                        card.style.display = category === 'social' ? 'block' : 'none';
                        break;
                    case 'category-environment':
                        card.style.display = category === 'environment' ? 'block' : 'none';
                        break;
                    case 'category-quality':
                        card.style.display = category === 'quality' ? 'block' : 'none';
                        break;
                    default:
                        card.style.display = 'block';
                }
            });
        }

        // Form step navigation
        function nextStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById(`step${step}`).classList.add('active');
        }

        function prevStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.getElementById(`step${step}`).classList.add('active');
        }

        // Featured image preview
        const featuredImageInput = document.getElementById('featuredImageInput');
        if (featuredImageInput) {
            featuredImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('featuredImagePreview');
                        preview.innerHTML = `
                            <div class="relative inline-block">
                                <img src="${e.target.result}" 
                                     class="w-48 h-32 object-cover rounded-lg border border-gray-300">
                                <button type="button" 
                                        onclick="removeFeaturedImage()"
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full hover:bg-red-600 flex items-center justify-center">
                                    &times;
                                </button>
                            </div>
                        `;

                        document.getElementById('featuredImageText').textContent = 'Image selected';
                        document.getElementById('featuredImageInfo').textContent =
                            `${file.name} (${(file.size/1024/1024).toFixed(2)} MB)`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeFeaturedImage = function() {
            document.getElementById('featuredImagePreview').innerHTML = '';
            document.getElementById('featuredImageInput').value = '';
            document.getElementById('featuredImageText').textContent = 'Upload featured image';
            document.getElementById('featuredImageInfo').textContent = 'Recommended: 1200x630px • Max: 2MB';
        };

        // Gallery images preview
        const galleryImagesInput = document.getElementById('galleryImagesInput');
        if (galleryImagesInput) {
            galleryImagesInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const preview = document.getElementById('galleryPreview');

                files.forEach((file, index) => {
                    if (file.size > 2 * 1024 * 1024) {
                        alert(`File "${file.name}" is too large (max 2MB)`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const item = document.createElement('div');
                        item.className = 'gallery-preview-item';
                        item.innerHTML = `
                            <img src="${e.target.result}" alt="Gallery preview">
                            <button type="button" onclick="removeGalleryImage(${index})">&times;</button>
                        `;
                        preview.appendChild(item);
                    };
                    reader.readAsDataURL(file);
                });
            });
        }

        window.removeGalleryImage = function(index) {
            const items = document.querySelectorAll('.gallery-preview-item');
            if (items[index]) {
                items[index].remove();
                // Update file input
                const dt = new DataTransfer();
                const files = Array.from(galleryImagesInput.files);
                files.splice(index, 1);
                files.forEach(file => dt.items.add(file));
                galleryImagesInput.files = dt.files;
            }
        };

        // Impact metrics
        let impactMetricCount = 1;
        window.addImpactMetric = function() {
            const container = document.getElementById('impactMetricsContainer');
            const div = document.createElement('div');
            div.className = 'impact-metric-item';
            div.innerHTML = `
                <input type="text" name="impact_metrics[${impactMetricCount}][name]" placeholder="Metric name"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text" name="impact_metrics[${impactMetricCount}][value]" placeholder="Value"
                    class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text" name="impact_metrics[${impactMetricCount}][unit]" placeholder="Unit"
                    class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button" onclick="this.parentElement.remove()"
                    class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    &times;
                </button>
            `;
            container.appendChild(div);
            impactMetricCount++;
        };

        // Team members
        let teamMemberCount = 1;
        window.addTeamMember = function() {
            const container = document.getElementById('teamMembersContainer');
            const div = document.createElement('div');
            div.className = 'team-member-item';
            div.innerHTML = `
                <input type="text" name="team_members[${teamMemberCount}][name]" placeholder="Name"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text" name="team_members[${teamMemberCount}][role]" placeholder="Role"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button" onclick="this.parentElement.remove()"
                    class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    &times;
                </button>
            `;
            container.appendChild(div);
            teamMemberCount++;
        };

        // Save as draft
        const saveAsDraftBtn = document.getElementById('saveAsDraftBtn');
        if (saveAsDraftBtn) {
            saveAsDraftBtn.addEventListener('click', () => {
                const draftRadio = document.querySelector('input[name="status"][value="draft"]');
                if (draftRadio) draftRadio.checked = true;
                csrForm.submit();
            });
        }

        // Form validation
        if (csrForm) {
            csrForm.addEventListener('submit', (e) => {
                const title = csrForm.querySelector('input[name="title"]').value.trim();
                const content = csrForm.querySelector('textarea[name="content"]').value.trim();

                if (!title) {
                    e.preventDefault();
                    alert('Please enter a program title');
                    csrForm.querySelector('input[name="title"]').focus();
                    return false;
                }

                if (!content) {
                    e.preventDefault();
                    alert('Please enter program description');
                    csrForm.querySelector('textarea[name="content"]').focus();
                    return false;
                }

                // Show loading state
                const submitBtn = csrForm.querySelector('button[type="submit"]');
                const saveAsDraftBtn = csrForm.querySelector('#saveAsDraftBtn');
                if (submitBtn) {
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Creating...';
                    submitBtn.disabled = true;
                    if (saveAsDraftBtn) saveAsDraftBtn.disabled = true;
                }

                return true;
            });
        }

        // Highlight new program if redirected from create
        @if (session('created_csr_id'))
            const newCard = document.querySelector(`[data-csr-id="{{ session('created_csr_id') }}"]`);
            if (newCard) {
                newCard.classList.add('new-program-highlight');
                setTimeout(() => {
                    newCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 500);

                // Remove highlight after 3 seconds
                setTimeout(() => {
                    newCard.classList.remove('new-program-highlight');
                }, 3000);
            }
        @endif

        // Initialize tooltips
        const initTooltips = () => {
            document.querySelectorAll('[title]').forEach(element => {
                element.addEventListener('mouseenter', (e) => {
                    const tooltip = document.createElement('div');
                    tooltip.className =
                        'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg';
                    tooltip.textContent = e.target.getAttribute('title');
                    document.body.appendChild(tooltip);

                    const rect = e.target.getBoundingClientRect();
                    tooltip.style.top = (rect.top - 30) + 'px';
                    tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';

                    e.target._tooltip = tooltip;
                });

                element.addEventListener('mouseleave', (e) => {
                    if (e.target._tooltip) {
                        e.target._tooltip.remove();
                    }
                });
            });
        };

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', () => {
            initTooltips();
            console.log('CSR Management page loaded successfully');
        });
    </script>
@endpush
