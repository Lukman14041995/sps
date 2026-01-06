@extends('admin.layouts.app')

@section('title', 'News Categories')

@push('styles')
    <style>
        /* Custom scrollbar for modal */
        #createModal .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        #createModal .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #createModal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        #createModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .dark #createModal .overflow-y-auto::-webkit-scrollbar-track {
            background: #374151;
        }

        .dark #createModal .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #6b7280;
        }

        /* Smooth transitions */
        #modalOverlay {
            opacity: 0;
            transition: opacity 0.3s ease-out;
        }

        #modalOverlay:not(.hidden) {
            opacity: 1;
        }

        #createModal {
            box-shadow: -20px 0 60px rgba(0, 0, 0, 0.3);
        }

        /* Drag & drop styles */
        .draggable-row.dragging {
            background: rgba(59, 130, 246, 0.1);
            border: 2px dashed #3b82f6;
            opacity: 0.8;
        }
        
        .draggable-handle {
            cursor: grab;
        }
        
        .draggable-handle:active {
            cursor: grabbing;
        }
        
        /* Inline edit styles - DIPERBAIKI */
        .edit-input-container {
            position: fixed !important;
            z-index: 9999 !important;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            animation: slideDown 0.2s ease-out;
            min-width: 300px;
            max-width: 500px;
        }

        .dark .edit-input-container {
            background: #1f2937;
            border-color: #374151;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Status toggle animation */
        .status-toggle:checked ~ .toggle-dot {
            transform: translateX(100%);
        }

        /* Toast styles */
        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            max-width: 24rem;
        }

        .toast {
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInRight 0.3s ease-out;
            opacity: 1;
            transform: translateX(0);
        }

        .toast.hiding {
            animation: slideOutRight 0.3s ease-in;
        }

        .toast-success {
            background-color: #10b981;
            color: white;
            border-left: 4px solid #059669;
        }

        .toast-error {
            background-color: #ef4444;
            color: white;
            border-left: 4px solid #dc2626;
        }

        .toast-warning {
            background-color: #f59e0b;
            color: white;
            border-left: 4px solid #d97706;
        }

        .toast-info {
            background-color: #3b82f6;
            color: white;
            border-left: 4px solid #2563eb;
        }

        .toast-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }

        .toast-icon {
            font-size: 1.25rem;
        }

        .toast-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0.25rem;
            margin-left: 0.75rem;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .toast-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        /* Description cell styling */
        .description-cell {
            max-width: 300px;
        }

        .read-more-btn {
            background: none;
            border: none;
            color: #3b82f6;
            cursor: pointer;
            font-size: 0.875rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
            text-decoration: underline;
        }

        .read-more-btn:hover {
            color: #2563eb;
        }

        /* Confirmation dialog */
        .confirmation-dialog {
            animation: scaleIn 0.2s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Professional table styles */
        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge.active {
            background-color: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .status-badge.inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .order-badge {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            font-weight: 700;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
        }

        .category-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 10px;
            color: #0ea5e9;
        }

        .dark .category-icon {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: #60a5fa;
        }

        /* Card styles for empty state */
        .empty-state-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed #cbd5e1;
        }

        .dark .empty-state-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 2px dashed #334155;
        }

        /* Animation for success */
        @keyframes successPulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        .success-pulse {
            animation: successPulse 1.5s infinite;
        }

        /* Toggle switch styles */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #10b981;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }

        /* Inline edit trigger */
        .inline-edit-trigger {
            cursor: pointer;
            transition: all 0.2s;
        }

        .inline-edit-trigger:hover {
            background-color: rgba(59, 130, 246, 0.05);
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Toast Container -->
        <div id="toastContainer" class="toast-container"></div>

        <!-- Header dengan gradient dan shadow -->
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white flex items-center gap-3">
                    <i class="fas fa-folder-tree text-blue-500"></i>
                    News Categories
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Manage and organize your news content into categories</p>
            </div>
            <button type="button" onclick="openCreateModal()"
                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl flex items-center space-x-3 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-plus-circle"></i>
                <span class="font-semibold">Add New Category</span>
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-blue-500 stats-card" data-type="total">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Categories</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-2" id="totalCategories">{{ $totalCategories }}</h3>
                    </div>
                    <i class="fas fa-layer-group text-3xl text-blue-500"></i>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-green-500 stats-card" data-type="active">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-2" id="activeCategories">{{ $activeCategories }}</h3>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-yellow-500 stats-card" data-type="inactive">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Inactive</p>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-2" id="inactiveCategories">{{ $inactiveCategories }}</h3>
                    </div>
                    <i class="fas fa-pause-circle text-3xl text-yellow-500"></i>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-purple-500 stats-card" data-type="last_added">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Last Added</p>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mt-2" id="lastAdded">{{ $lastAdded }}</h3>
                    </div>
                    <i class="fas fa-clock text-3xl text-purple-500"></i>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div
                class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Category List</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Manage all your news categories in one place
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" placeholder="Search categories..."
                            class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white w-full md:w-64">
                    </div>
                    <button
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <i class="fas fa-filter text-gray-600 dark:text-gray-300"></i>
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <span>Category</span>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Slug
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Order
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700" id="sortableTable">
                        @forelse ($categories as $category)
                            <tr class="table-row-hover transition-all duration-200 draggable-row" 
                                data-id="{{ $category->id }}" data-order="{{ $category->order }}">
                                <!-- Category dengan inline edit -->
                                <td class="px-8 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="category-icon">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="group relative">
                                                <div class="inline-edit-trigger inline-edit-field cursor-pointer" 
                                                     data-field="name" 
                                                     data-id="{{ $category->id }}"
                                                     data-original-value="{{ $category->name }}">
                                                    <div class="flex items-center">
                                                        <span class="text-gray-800 dark:text-white font-semibold text-base category-name-{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </span>
                                                        <i class="fas fa-edit ml-3 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity text-sm"></i>
                                                    </div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                        <i class="fas fa-calendar-alt mr-1"></i>
                                                        Created {{ $category->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="hidden edit-input-container" id="edit-container-name-{{ $category->id }}">
                                                    <div class="p-4">
                                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                            Edit Category Name
                                                        </label>
                                                        <input type="text" 
                                                               class="inline-edit-input px-4 py-3 w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 dark:text-white"
                                                               value="{{ $category->name }}"
                                                               data-field="name"
                                                               data-id="{{ $category->id }}">
                                                    </div>
                                                    <div class="flex justify-end space-x-2 p-3 border-t border-gray-100 dark:border-gray-700">
                                                        <button type="button" class="inline-edit-cancel px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                                                            Cancel
                                                        </button>
                                                        <button type="button" class="inline-edit-save px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center space-x-2">
                                                            <i class="fas fa-save text-xs"></i>
                                                            <span>Save Changes</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Slug -->
                                <td class="px-8 py-4">
                                    <div class="group relative">
                                        <div class="inline-edit-trigger inline-edit-field cursor-pointer" 
                                             data-field="slug" 
                                             data-id="{{ $category->id }}"
                                             data-original-value="{{ $category->slug }}">
                                            <div class="flex items-center">
                                                <code class="text-xs bg-gray-100 dark:bg-gray-700 px-3 py-1.5 rounded-lg text-gray-800 dark:text-gray-200 font-mono category-slug-{{ $category->id }}">
                                                    /{{ $category->slug }}
                                                </code>
                                                <i class="fas fa-edit ml-3 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="hidden edit-input-container" id="edit-container-slug-{{ $category->id }}">
                                            <div class="p-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Edit URL Slug
                                                </label>
                                                <input type="text" 
                                                       class="inline-edit-input px-4 py-3 w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 dark:text-white"
                                                       value="{{ $category->slug }}"
                                                       data-field="slug"
                                                       data-id="{{ $category->id }}">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    Used in URLs. Use lowercase letters, numbers, and hyphens.
                                                </p>
                                            </div>
                                            <div class="flex justify-end space-x-2 p-3 border-t border-gray-100 dark:border-gray-700">
                                                <button type="button" class="inline-edit-cancel px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                                                    Cancel
                                                </button>
                                                <button type="button" class="inline-edit-save px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center space-x-2">
                                                    <i class="fas fa-save text-xs"></i>
                                                    <span>Save Changes</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Description dengan inline edit -->
                                <td class="px-8 py-4">
                                    <div class="group relative">
                                        <div class="inline-edit-trigger inline-edit-field cursor-pointer description-cell" 
                                             data-field="description" 
                                             data-id="{{ $category->id }}"
                                             data-original-value="{{ $category->description ?? '' }}">
                                            @if($category->description)
                                                <div class="flex items-start">
                                                    <span class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed category-description-{{ $category->id }}">
                                                        {{ Str::limit($category->description, 80) }}
                                                    </span>
                                                    @if(strlen($category->description) > 80)
                                                        <button type="button" class="read-more-btn text-xs ml-2" onclick="toggleDescription(this, {{ $category->id }})">
                                                            Read more
                                                        </button>
                                                    @endif
                                                    <i class="fas fa-edit ml-3 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity text-sm mt-1"></i>
                                                </div>
                                            @else
                                                <div class="flex items-center">
                                                    <span class="text-gray-400 dark:text-gray-500 italic text-sm category-description-{{ $category->id }}">
                                                        <i class="fas fa-align-left mr-2"></i>
                                                        No description
                                                    </span>
                                                    <i class="fas fa-edit ml-3 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="hidden edit-input-container" id="edit-container-description-{{ $category->id }}">
                                            <div class="p-4">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Edit Description
                                                </label>
                                                <textarea 
                                                    class="inline-edit-input px-4 py-3 w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-800 dark:text-white resize-none"
                                                    rows="4"
                                                    data-field="description"
                                                    data-id="{{ $category->id }}"
                                                    placeholder="Enter category description...">{{ $category->description ?? '' }}</textarea>
                                            </div>
                                            <div class="flex justify-end space-x-2 p-3 border-t border-gray-100 dark:border-gray-700">
                                                <button type="button" class="inline-edit-cancel px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                                                    Cancel
                                                </button>
                                                <button type="button" class="inline-edit-save px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center space-x-2">
                                                    <i class="fas fa-save text-xs"></i>
                                                    <span>Save Changes</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Order -->
                                <td class="px-8 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="order-badge order-number-{{ $category->id }}">
                                            {{ $category->order }}
                                        </div>
                                        <i class="fas fa-grip-vertical ml-2 text-gray-400 cursor-move draggable-handle hover:text-blue-500 transition"></i>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            Drag to reorder
                                        </span>
                                    </div>
                                </td>
                                
                                <!-- Status dengan toggle -->
                                <td class="px-8 py-4">
                                    <div class="flex flex-col space-y-2">
                                        <label class="toggle-switch">
                                            <input type="checkbox" 
                                                   class="status-toggle" 
                                                   data-id="{{ $category->id }}"
                                                   {{ $category->is_active ? 'checked' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                        <div class="status-badge status-badge-{{ $category->id }} {{ $category->is_active ? 'active' : 'inactive' }}">
                                            <i class="fas {{ $category->is_active ? 'fa-check-circle' : 'fa-pause-circle' }} text-xs"></i>
                                            <span>{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-8 py-4">
                                    <div class="flex items-center space-x-2">
                                        <button type="button" onclick="confirmDelete({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                            class="px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-300 flex items-center space-x-2 group">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                            <span class="text-sm font-medium group-hover:scale-105 transition-transform">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-16">
                                    <div class="empty-state-card rounded-2xl p-12 text-center transition-all duration-300 hover:scale-[1.02]">
                                        <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-full flex items-center justify-center mx-auto mb-8">
                                            <i class="fas fa-folder-open text-5xl text-blue-500 dark:text-blue-400"></i>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">No Categories Yet</h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                                            Start organizing your news content by creating categories. Categories help you manage and filter your content efficiently.
                                        </p>
                                        <button onclick="openCreateModal()"
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-8 py-3 rounded-xl flex items-center space-x-3 transition-all duration-300 shadow-lg hover:shadow-xl mx-auto transform hover:-translate-y-1">
                                            <i class="fas fa-plus-circle"></i>
                                            <span class="font-semibold">Create Your First Category</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer dengan info summary -->
            @if($categories->isNotEmpty())
                <div class="px-8 py-4 border-t border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-800/50 dark:to-gray-900/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-semibold text-gray-800 dark:text-white categories-count">{{ $categories->count() }}</span> categories displayed
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Drag <i class="fas fa-grip-vertical mx-1"></i> icon to reorder • Click on text to edit • Toggle switch to change status
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Overlay Background -->
    <div id="modalOverlay"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-40 hidden transition-all duration-300 ease-out"
        onclick="closeCreateModal()"></div>

    <!-- Create Category Modal/Slide-in Panel -->
    <div id="createModal"
        class="fixed top-0 right-0 h-full w-full md:w-1/2 lg:w-1/3 bg-white dark:bg-gray-800 shadow-2xl z-50 transform transition-all duration-500 ease-out translate-x-full">

        <div class="h-full flex flex-col">
            <!-- Modal Header dengan gradient -->
            <div class="px-8 py-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Add New Category</h2>
                        <p class="text-blue-100 text-sm mt-1">Create a new category for your news content</p>
                    </div>
                    <button type="button" onclick="closeCreateModal()" class="text-white hover:text-blue-200 transition">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-8">
                <form id="categoryForm" method="POST" action="{{ route('admin.news-categories.store') }}">
                    @csrf

                    <div class="space-y-8">
                        <!-- Name Field -->
                        <div>
                            <label for="name"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center justify-between">
                                <span>Category Name</span>
                                <span class="text-xs text-red-500">* Required</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                    placeholder="e.g., Technology News" required>
                            </div>
                            <div id="name-error"
                                class="mt-2 text-sm text-red-600 hidden bg-red-50 dark:bg-red-900/20 p-3 rounded-lg"></div>
                        </div>

                        <!-- Slug Field -->
                        <div>
                            <label for="slug"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                URL Slug
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-link text-gray-400"></i>
                                </div>
                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                    class="pl-10 w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                    placeholder="technology-news" required>
                                <button type="button" id="regenerateSlug"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition text-sm flex items-center space-x-2">
                                    <i class="fas fa-sync-alt text-xs"></i>
                                    <span>Regenerate</span>
                                </button>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Used in URLs. Automatically generated from the name.
                            </p>
                            <div id="slug-error"
                                class="mt-2 text-sm text-red-600 hidden bg-red-50 dark:bg-red-900/20 p-3 rounded-lg"></div>
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                <span class="flex items-center">
                                    <i class="fas fa-align-left mr-2 text-gray-500"></i>
                                    Description
                                </span>
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition resize-none"
                                placeholder="Describe this category (optional)">{{ old('description') }}</textarea>
                            <div id="description-error"
                                class="mt-2 text-sm text-red-600 hidden bg-red-50 dark:bg-red-900/20 p-3 rounded-lg"></div>
                        </div>

                        <!-- Order and Status Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Order Field -->
                            <div>
                                <label for="order"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <i class="fas fa-sort-numeric-down mr-2 text-gray-500"></i>
                                        Display Order
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-sort-amount-down text-gray-400"></i>
                                    </div>
                                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}"
                                        min="0"
                                        class="pl-10 w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition"
                                        placeholder="0">
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Lower numbers appear first
                                </p>
                                <div id="order-error"
                                    class="mt-2 text-sm text-red-600 hidden bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    <span class="flex items-center">
                                        <i class="fas fa-toggle-on mr-2 text-gray-500"></i>
                                        Status
                                    </span>
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="is_active" value="1"
                                            {{ old('is_active', 1) == 1 ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="p-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition">
                                            <div class="flex items-center justify-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                                    <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-800 dark:text-white">Active</div>
                                                    <div class="text-xs text-gray-500">Visible to users</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="is_active" value="0"
                                            {{ old('is_active') == 0 ? 'checked' : '' }} class="sr-only peer">
                                        <div
                                            class="p-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 transition">
                                            <div class="flex items-center justify-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center mr-3">
                                                    <i class="fas fa-pause text-red-600 dark:text-red-400"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-800 dark:text-white">Inactive</div>
                                                    <div class="text-xs text-gray-500">Hidden from users</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div id="is_active-error"
                                    class="mt-2 text-sm text-red-600 hidden bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="px-8 py-6 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 flex justify-end space-x-4">
                <button type="button" onclick="closeCreateModal()"
                    class="px-8 py-3 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300 font-medium flex items-center space-x-2">
                    <i class="fas fa-times"></i>
                    <span>Cancel</span>
                </button>
                <button type="button" onclick="submitForm()"
                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition-all duration-300 font-medium flex items-center space-x-3 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save"></i>
                    <span>Create Category</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // ========== TOAST FUNCTIONS ==========
        function showToast(message, type = 'success', duration = 3000) {
            const container = document.getElementById('toastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };

            toast.innerHTML = `
                <div class="toast-content">
                    <i class="${icons[type] || icons.info} toast-icon"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close" onclick="removeToast(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(toast);

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.classList.add('hiding');
                    setTimeout(() => {
                        if (toast.parentNode) {
                            container.removeChild(toast);
                        }
                    }, 300);
                }
            }, duration);
        }

        function removeToast(button) {
            const toast = button.closest('.toast');
            if (toast && toast.parentNode) {
                toast.classList.add('hiding');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        }

        // ========== CONFIRMATION DIALOG ==========
        function showConfirmationDialog(title, message) {
            return new Promise((resolve) => {
                const dialog = document.createElement('div');
                dialog.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4';
                dialog.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full confirmation-dialog">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">${title}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${message}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 flex justify-end space-x-3">
                            <button type="button" class="cancel-btn px-5 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium">
                                Cancel
                            </button>
                            <button type="button" class="confirm-btn px-5 py-2.5 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium">
                                Delete
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(dialog);

                const confirmBtn = dialog.querySelector('.confirm-btn');
                const cancelBtn = dialog.querySelector('.cancel-btn');
                const modal = dialog.querySelector('.confirmation-dialog');

                function closeDialog(result) {
                    if (modal) {
                        modal.style.opacity = '0';
                        modal.style.transform = 'scale(0.95)';
                    }
                    
                    setTimeout(() => {
                        if (dialog.parentNode) {
                            dialog.parentNode.removeChild(dialog);
                        }
                        resolve(result);
                    }, 200);
                }

                confirmBtn.onclick = () => closeDialog(true);
                cancelBtn.onclick = () => closeDialog(false);

                dialog.onclick = (e) => {
                    if (e.target === dialog) {
                        closeDialog(false);
                    }
                };
            });
        }

        // ========== HELPER FUNCTIONS ==========
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        }

        function generateSlug(text) {
            if (!text) return '';
            return text.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '')
                .trim();
        }

        function clearErrorMessages() {
            document.querySelectorAll('[id$="-error"]').forEach(element => {
                if (element) {
                    element.classList.add('hidden');
                    element.textContent = '';
                }
            });
        }

        function showError(field, message) {
            const errorElement = document.getElementById(`${field}-error`);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            }
        }

        // ========== MODAL FUNCTIONS ==========
        function openCreateModal() {
            const modal = document.getElementById('createModal');
            const overlay = document.getElementById('modalOverlay');
            if (modal && overlay) {
                modal.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                setTimeout(() => {
                    const nameInput = document.getElementById('name');
                    if (nameInput) nameInput.focus();
                }, 300);
            }
        }

        function closeCreateModal() {
            const modal = document.getElementById('createModal');
            const overlay = document.getElementById('modalOverlay');
            if (modal && overlay) {
                modal.classList.add('translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                resetForm();
            }
        }

        function resetForm() {
            const form = document.getElementById('categoryForm');
            if (form) {
                form.reset();
                clearErrorMessages();
                const activeRadio = document.querySelector('input[name="is_active"][value="1"]');
                if (activeRadio) activeRadio.checked = true;
            }
        }

        // ========== FORM SUBMISSION ==========
        function submitForm() {
            const form = document.getElementById('categoryForm');
            if (!form) {
                showToast('Form not found', 'error');
                return;
            }

            const formData = new FormData(form);
            clearErrorMessages();

            const name = document.getElementById('name')?.value.trim();
            const slug = document.getElementById('slug')?.value.trim();

            if (!name) {
                showError('name', 'Please enter a category name');
                return;
            }

            if (!slug) {
                showError('slug', 'Please enter a valid slug');
                return;
            }

            const slugRegex = /^[a-z0-9]+(?:-[a-z0-9]+)*$/;
            if (!slugRegex.test(slug)) {
                showError('slug', 'Slug can only contain lowercase letters, numbers, and hyphens.');
                return;
            }

            const submitBtn = document.querySelector('button[onclick="submitForm()"]');
            if (!submitBtn) return;

            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <div class="flex items-center space-x-2">
                    <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Saving...</span>
                </div>
            `;
            submitBtn.disabled = true;

            const csrfToken = getCsrfToken();

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(async response => {
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({}));
                    throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Category created successfully!', 'success');
                    closeCreateModal();
                    setTimeout(() => window.location.reload(), 1500);
                } else if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        showError(field, data.errors[field][0]);
                    });
                    showToast('Please fix the errors in the form', 'error');
                } else {
                    showToast(data.message || 'An error occurred', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                showToast(error.message || 'Failed to save category. Please try again.', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }

        // ========== INLINE EDITING FUNCTIONALITY - DIPERBAIKI ==========
        let activeEditContainer = null;

        function initializeInlineEditing() {
            console.log('Initializing inline editing...');
            
            // Event delegation untuk klik pada field
            document.addEventListener('click', function(e) {
                console.log('Click event:', e.target);
                
                // Jika klik pada read more button, skip
                if (e.target.closest('.read-more-btn')) {
                    return;
                }
                
                // Tutup container aktif jika ada
                if (activeEditContainer && !activeEditContainer.contains(e.target)) {
                    activeEditContainer.classList.add('hidden');
                    activeEditContainer = null;
                }
                
                // Cari field yang diklik
                const clickedField = e.target.closest('.inline-edit-trigger');
                if (!clickedField) return;
                
                console.log('Clicked on field:', clickedField.dataset.field);
                openEditField(clickedField);
            });
            
            function openEditField(field) {
                const fieldName = field.dataset.field;
                const categoryId = field.dataset.id;
                const containerId = `edit-container-${fieldName}-${categoryId}`;
                const container = document.getElementById(containerId);
                
                if (!container) {
                    console.error('Edit container not found:', containerId);
                    return;
                }
                
                // Tutup container aktif sebelumnya
                if (activeEditContainer) {
                    activeEditContainer.classList.add('hidden');
                }
                
                // Posisikan container
                const rect = field.getBoundingClientRect();
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
                
                container.style.position = 'fixed';
                container.style.left = (rect.left + scrollLeft) + 'px';
                container.style.top = (rect.top + scrollTop + rect.height + 5) + 'px';
                container.style.zIndex = '9999';
                
                // Tampilkan container
                container.classList.remove('hidden');
                activeEditContainer = container;
                
                // Fokus ke input
                const input = container.querySelector('.inline-edit-input');
                if (input) {
                    setTimeout(() => {
                        input.focus();
                        input.select();
                    }, 10);
                }
                
                // Setup cancel button
                const cancelBtn = container.querySelector('.inline-edit-cancel');
                if (cancelBtn) {
                    cancelBtn.onclick = (e) => {
                        e.stopPropagation();
                        container.classList.add('hidden');
                        activeEditContainer = null;
                        const originalValue = field.dataset.originalValue || '';
                        if (input) input.value = originalValue;
                    };
                }
                
                // Setup save button
                const saveBtn = container.querySelector('.inline-edit-save');
                if (saveBtn) {
                    saveBtn.onclick = (e) => {
                        e.stopPropagation();
                        saveEditField(field, container, input);
                    };
                }
                
                // Close on Escape
                const handleKeydown = (e) => {
                    if (e.key === 'Escape') {
                        container.classList.add('hidden');
                        activeEditContainer = null;
                        const originalValue = field.dataset.originalValue || '';
                        if (input) input.value = originalValue;
                        document.removeEventListener('keydown', handleKeydown);
                    }
                };
                document.addEventListener('keydown', handleKeydown);
            }
            
            async function saveEditField(field, container, input) {
                const newValue = input.value.trim();
                const originalValue = field.dataset.originalValue;
                const fieldName = field.dataset.field;
                const categoryId = field.dataset.id;
                
                console.log('Saving field:', { fieldName, categoryId, newValue, originalValue });
                
                if (!newValue && fieldName !== 'description') {
                    showToast('Value cannot be empty', 'error');
                    return;
                }
                
                if (newValue === originalValue) {
                    container.classList.add('hidden');
                    activeEditContainer = null;
                    return;
                }
                
                // Tampilkan loading
                const saveBtn = container.querySelector('.inline-edit-save');
                const originalBtnText = saveBtn.innerHTML;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i> Saving...';
                saveBtn.disabled = true;
                
                try {
                    const csrfToken = getCsrfToken();
                    
                    const response = await fetch('{{ route("admin.news-categories.update-inline") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            id: categoryId,
                            field: fieldName,
                            value: newValue
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Update UI
                        updateFieldDisplay(categoryId, fieldName, newValue);
                        field.dataset.originalValue = newValue;
                        container.classList.add('hidden');
                        activeEditContainer = null;
                        
                        showToast(data.message || 'Updated successfully', 'success');
                    } else {
                        showToast(data.message || 'Update failed', 'error');
                        if (input) input.value = originalValue;
                    }
                } catch (error) {
                    console.error('Error updating field:', error);
                    showToast('Failed to update. Please try again.', 'error');
                    if (input) input.value = originalValue;
                } finally {
                    saveBtn.innerHTML = originalBtnText;
                    saveBtn.disabled = false;
                }
            }
        }

        function updateFieldDisplay(categoryId, fieldName, value) {
            console.log('Updating display for:', fieldName, value, categoryId);
            
            if (fieldName === 'name') {
                const element = document.querySelector(`.category-name-${categoryId}`);
                if (element) {
                    element.textContent = value;
                }
            } else if (fieldName === 'slug') {
                const element = document.querySelector(`.category-slug-${categoryId}`);
                if (element) {
                    element.textContent = '/' + value;
                }
            } else if (fieldName === 'description') {
                const element = document.querySelector(`.category-description-${categoryId}`);
                if (element) {
                    if (value) {
                        const shortText = value.length > 80 ? value.substring(0, 80) + '...' : value;
                        element.textContent = shortText;
                        element.className = 'text-gray-600 dark:text-gray-300 text-sm leading-relaxed';
                        
                        // Update read more button
                        const parentDiv = element.closest('.flex.items-start');
                        if (parentDiv) {
                            const readMoreBtn = parentDiv.querySelector('.read-more-btn');
                            if (value.length > 80) {
                                if (!readMoreBtn) {
                                    const btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.className = 'read-more-btn text-xs ml-2';
                                    btn.textContent = 'Read more';
                                    btn.onclick = function() { toggleDescription(this, categoryId); };
                                    parentDiv.appendChild(btn);
                                }
                            } else if (readMoreBtn) {
                                readMoreBtn.remove();
                            }
                        }
                    } else {
                        element.innerHTML = '<i class="fas fa-align-left mr-2"></i>No description';
                        element.className = 'text-gray-400 dark:text-gray-500 italic text-sm';
                    }
                }
            }
        }

        // ========== DESCRIPTION TOGGLE ==========
        function toggleDescription(button, categoryId) {
            const element = document.querySelector(`.category-description-${categoryId}`);
            const fullText = document.querySelector(`[data-field="description"][data-id="${categoryId}"]`)?.dataset.originalValue || '';
            
            if (!element) return;
            
            const currentText = element.textContent;
            
            if (currentText.length < fullText.length || currentText.endsWith('...')) {
                // Expand
                element.textContent = fullText;
                button.textContent = 'Read less';
            } else {
                // Collapse
                const shortText = fullText.length > 80 ? fullText.substring(0, 80) + '...' : fullText;
                element.textContent = shortText;
                button.textContent = 'Read more';
            }
        }

        // ========== STATUS TOGGLE FUNCTIONALITY - DIPERBAIKI ==========
        function initializeStatusToggle() {
            console.log('Initializing status toggle...');
            
            document.addEventListener('change', async function(e) {
                if (e.target.classList.contains('status-toggle')) {
                    const toggle = e.target;
                    const categoryId = toggle.dataset.id;
                    const isActive = toggle.checked ? 1 : 0;
                    
                    console.log('Status toggle clicked:', { categoryId, isActive });
                    
                    // Tampilkan loading
                    toggle.disabled = true;
                    
                    try {
                        const csrfToken = getCsrfToken();
                        
                        const response = await fetch('{{ route("admin.news-categories.toggle-status") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                id: categoryId,
                                is_active: isActive
                            })
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Update UI
                            updateStatusDisplay(categoryId, isActive);
                            updateStatsCards(); // Auto update stats cards
                            showToast('Status updated successfully', 'success');
                        } else {
                            // Revert toggle
                            toggle.checked = !toggle.checked;
                            showToast(data.message || 'Failed to update status', 'error');
                        }
                    } catch (error) {
                        console.error('Error toggling status:', error);
                        toggle.checked = !toggle.checked;
                        showToast('Failed to update status', 'error');
                    } finally {
                        toggle.disabled = false;
                    }
                }
            });
        }

        function updateStatusDisplay(categoryId, isActive) {
            const statusBadge = document.querySelector(`.status-badge-${categoryId}`);
            const statusIcon = statusBadge?.querySelector('i');
            const statusText = statusBadge?.querySelector('span');
            
            if (statusBadge && statusIcon && statusText) {
                if (isActive) {
                    statusBadge.className = `status-badge status-badge-${categoryId} active`;
                    statusIcon.className = 'fas fa-check-circle text-xs';
                    statusText.textContent = 'Active';
                } else {
                    statusBadge.className = `status-badge status-badge-${categoryId} inactive`;
                    statusIcon.className = 'fas fa-pause-circle text-xs';
                    statusText.textContent = 'Inactive';
                }
            }
        }

        // ========== UPDATE STATS CARDS - DIPERBAIKI ==========
        async function updateStatsCards() {
            try {
                const response = await fetch('{{ route("admin.news-categories.stats") }}');
                const data = await response.json();
                
                if (data.success) {
                    // Update stats cards
                    const totalElement = document.getElementById('totalCategories');
                    const activeElement = document.getElementById('activeCategories');
                    const inactiveElement = document.getElementById('inactiveCategories');
                    const lastAddedElement = document.getElementById('lastAdded');
                    
                    if (totalElement) totalElement.textContent = data.total;
                    if (activeElement) activeElement.textContent = data.active;
                    if (inactiveElement) inactiveElement.textContent = data.inactive;
                    if (lastAddedElement) lastAddedElement.textContent = data.last_added;
                    
                    // Add animation effect
                    [totalElement, activeElement, inactiveElement].forEach(el => {
                        if (el) {
                            el.classList.add('text-green-500');
                            setTimeout(() => {
                                el.classList.remove('text-green-500');
                            }, 1000);
                        }
                    });
                }
            } catch (error) {
                console.error('Error updating stats:', error);
            }
        }

        // ========== DRAG & DROP FUNCTIONALITY ==========
        function initializeDragDrop() {
            const table = document.getElementById('sortableTable');
            if (!table) return;
            
            const handles = table.querySelectorAll('.draggable-handle');
            
            handles.forEach(handle => {
                handle.addEventListener('mousedown', startDrag);
            });
            
            function startDrag(e) {
                const row = e.target.closest('.draggable-row');
                if (!row) return;
                
                row.classList.add('dragging');
                
                document.addEventListener('mousemove', onDrag);
                document.addEventListener('mouseup', stopDrag);
                
                e.preventDefault();
            }
            
            function onDrag(e) {
                const draggingRow = document.querySelector('.dragging');
                if (!draggingRow) return;
                
                const rows = Array.from(table.querySelectorAll('.draggable-row:not(.dragging)'));
                const closestRow = getClosestRow(rows, e.clientY);
                
                if (closestRow) {
                    table.insertBefore(draggingRow, closestRow);
                } else {
                    table.appendChild(draggingRow);
                }
            }
            
            function stopDrag() {
                const draggingRow = document.querySelector('.dragging');
                if (!draggingRow) return;
                
                draggingRow.classList.remove('dragging');
                updateRowOrders();
                
                document.removeEventListener('mousemove', onDrag);
                document.removeEventListener('mouseup', stopDrag);
            }
            
            function getClosestRow(rows, y) {
                return rows.reduce((closest, row) => {
                    const box = row.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: row };
                    }
                    return closest;
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }
            
            async function updateRowOrders() {
                const rows = table.querySelectorAll('.draggable-row');
                const orderData = [];
                
                rows.forEach((row, index) => {
                    const id = row.dataset.id;
                    const order = index + 1;
                    
                    row.dataset.order = order;
                    const orderBadge = row.querySelector(`.order-number-${id}`);
                    if (orderBadge) {
                        orderBadge.textContent = order;
                    }
                    
                    orderData.push({ id: parseInt(id), order: order });
                });
                
                try {
                    const csrfToken = getCsrfToken();
                    const response = await fetch('{{ route("admin.news-categories.update-order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ orders: orderData })
                    });
                    
                    const data = await response.json();
                    
                    if (!data.success) {
                        showToast(data.message || 'Failed to update order', 'error');
                    } else {
                        showToast('Order updated successfully', 'success');
                    }
                } catch (error) {
                    console.error('Error updating order:', error);
                    showToast('Failed to update order', 'error');
                }
            }
        }

        // ========== DELETE FUNCTIONALITY ==========
        async function confirmDelete(id, name) {
            const result = await showConfirmationDialog(
                'Delete Category',
                `Are you sure you want to delete "${name}"? This action cannot be undone.`
            );
            
            if (result) {
                await deleteCategory(id);
            }
        }
        
        async function deleteCategory(id) {
            try {
                const csrfToken = getCsrfToken();
                const response = await fetch(`{{ url('admin/news-categories') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast('Category deleted successfully', 'success');
                    // Update stats setelah delete
                    updateStatsCards();
                    // Remove row dari table
                    const row = document.querySelector(`.draggable-row[data-id="${id}"]`);
                    if (row) {
                        row.style.opacity = '0.5';
                        row.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            row.remove();
                            // Update count
                            const countElement = document.querySelector('.categories-count');
                            if (countElement) {
                                const currentCount = parseInt(countElement.textContent);
                                countElement.textContent = currentCount - 1;
                            }
                        }, 300);
                    }
                } else {
                    showToast(data.message || 'Failed to delete category', 'error');
                }
            } catch (error) {
                console.error('Error deleting category:', error);
                showToast('Failed to delete category', 'error');
            }
        }

        // ========== SEARCH FUNCTIONALITY ==========
        function initializeSearch() {
            const searchInput = document.getElementById('searchInput');
            if (!searchInput) return;
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const rows = document.querySelectorAll('.draggable-row');
                
                if (!searchTerm) {
                    rows.forEach(row => row.style.display = '');
                    return;
                }
                
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const id = row.dataset.id;
                    const name = row.querySelector(`.category-name-${id}`)?.textContent.toLowerCase();
                    const slug = row.querySelector(`.category-slug-${id}`)?.textContent.toLowerCase();
                    const description = row.querySelector(`.category-description-${id}`)?.textContent.toLowerCase();
                    
                    const matches = name?.includes(searchTerm) || 
                                  slug?.includes(searchTerm) || 
                                  description?.includes(searchTerm);
                    
                    if (matches) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Update count
                const countElement = document.querySelector('.categories-count');
                if (countElement) {
                    countElement.textContent = visibleCount;
                }
            });
        }

        // ========== INITIALIZATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            // Slug generation in create modal
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            const regenerateBtn = document.getElementById('regenerateSlug');

            if (nameInput && slugInput) {
                let isManualSlugEdit = false;
                
                nameInput.addEventListener('input', function() {
                    if (!isManualSlugEdit && nameInput.value.trim() !== '') {
                        slugInput.value = generateSlug(nameInput.value);
                    }
                });

                slugInput.addEventListener('focus', function() {
                    isManualSlugEdit = true;
                });

                slugInput.addEventListener('input', function() {
                    isManualSlugEdit = true;
                });

                if (regenerateBtn) {
                    regenerateBtn.addEventListener('click', function() {
                        if (nameInput.value.trim() !== '') {
                            slugInput.value = generateSlug(nameInput.value);
                            isManualSlugEdit = false;
                        }
                    });
                }
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeCreateModal();
                }
            });

            // Prevent modal close when clicking inside
            const modal = document.getElementById('createModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Initialize modal state
            const initModal = document.getElementById('createModal');
            const initOverlay = document.getElementById('modalOverlay');
            if (initModal && initOverlay) {
                initModal.classList.add('translate-x-full');
                initOverlay.classList.add('hidden');
            }

            // Initialize all features
            initializeInlineEditing();
            initializeDragDrop();
            initializeStatusToggle();
            initializeSearch();

            // Session messages
            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showToast("{{ $error }}", 'error');
                @endforeach
            @endif
            
            console.log('Initialization complete');
        });
    </script>
@endpush