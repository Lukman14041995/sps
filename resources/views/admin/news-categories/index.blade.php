@extends('admin.layouts.app')
@section('title', 'News Categories')
@push('styles')
    <style>
        .edit-box {
            position: fixed;
            z-index: 9999;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .2);
            min-width: 280px;
            max-width: 90vw;
            padding: 14px;
        }

        .dark .edit-box {
            background: #1f2937;
            border-color: #374151;
        }

        .toast {
            padding: 12px 16px;
            border-radius: 10px;
            color: #fff;
            display: flex;
            gap: 12px;
            justify-content: space-between;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast-success {
            background: #16a34a;
        }

        .toast-error {
            background: #dc2626;
        }

        .sortable-ghost {
            opacity: .4;
            background: #dbeafe;
        }

        .sortable-drag {
            cursor: grabbing !important;
            transform: rotate(3deg);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .drag-handle {
            cursor: grab;
            color: #6b7280;
            touch-action: none;
            transition: color 0.2s;
        }

        .drag-handle:hover {
            color: #2563eb;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.95);
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .dark .modal-content {
            background: #1f2937;
            color: white;
        }

        .status-toggle {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
            border-radius: 15px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .status-toggle.active {
            background-color: #10b981;
        }

        .status-toggle.inactive {
            background-color: #6b7280;
        }

        .status-toggle::after {
            content: '';
            position: absolute;
            top: 3px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .status-toggle.active::after {
            left: calc(100% - 27px);
        }

        .status-toggle.inactive::after {
            left: 3px;
        }

        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -1rem;
                padding: 0 1rem;
            }

            table {
                min-width: 640px;
                width: 100%;
            }

            .mobile-action-buttons {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }
        }

        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
            display: none;
        }

        .dark .loading-overlay {
            background: rgba(17, 24, 39, 0.8);
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e5e7eb;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .order-updating {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                background-color: transparent;
            }

            50% {
                background-color: rgba(59, 130, 246, 0.1);
            }
        }
    </style>
@endpush

@section('content')
    {{-- Loading Overlay --}}
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        {{-- Toast Container --}}
        <div id="toastWrap" class="fixed top-4 right-4 z-50 space-y-2 max-w-sm"></div>

        <div class="container-fluid px-0">
            {{-- Header --}}
            <div class="px-4 md:px-6 py-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">News Categories</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Manage your news categories and their order</p>
                    </div>
                    <button id="openAddModal"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Add Category
                    </button>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="px-4 md:px-6 py-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="table-container">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="p-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="p-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Slug
                                    </th>
                                    <th
                                        class="p-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th
                                        class="p-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Order
                                    </th>
                                    <th
                                        class="p-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="p-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="tableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($categories as $cat)
                                    <tr class="draggable-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors"
                                        data-id="{{ $cat->id }}">

                                        {{-- Name --}}
                                        <td class="p-4">
                                            <div class="inline-edit cursor-pointer group" data-field="name"
                                                data-id="{{ $cat->id }}">
                                                <span
                                                    class="name-{{ $cat->id }} font-medium text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">
                                                    {{ $cat->name }}
                                                </span>
                                                <span
                                                    class="ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Slug --}}
                                        <td class="p-4">
                                            <div class="inline-edit cursor-pointer group" data-field="slug"
                                                data-id="{{ $cat->id }}">
                                                <span
                                                    class="slug-{{ $cat->id }} text-gray-600 dark:text-gray-400 group-hover:text-blue-600 transition-colors">
                                                    /{{ $cat->slug }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Description --}}
                                        <td class="p-4">
                                            <div class="inline-edit cursor-pointer group" data-field="description"
                                                data-id="{{ $cat->id }}">
                                                <span
                                                    class="desc-{{ $cat->id }} text-gray-600 dark:text-gray-400 truncate max-w-[200px] group-hover:text-blue-600 transition-colors">
                                                    {{ $cat->description ?: 'No description' }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Order --}}
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <i
                                                    class="fas fa-grip-vertical drag-handle text-gray-400 hover:text-blue-500 transition-colors"></i>
                                                <span
                                                    class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/20 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold order-{{ $cat->id }}">
                                                    {{ $cat->order }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Status --}}
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <button type="button"
                                                    class="status-toggle {{ $cat->is_active ? 'active' : 'inactive' }}"
                                                    data-id="{{ $cat->id }}" data-active="{{ $cat->is_active }}"
                                                    aria-label="Toggle status">
                                                </button>
                                                <span
                                                    class="ml-2 text-xs font-medium statusText-{{ $cat->id }} {{ $cat->is_active ? 'text-green-600' : 'text-gray-600' }}">
                                                    {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="p-4">
                                            <div class="flex justify-center">
                                                @if ($cat->news_count > 0)
                                                    <span
                                                        class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full text-xs">
                                                        <i class="fas fa-link mr-1"></i> Used
                                                    </span>
                                                @else
                                                    <div class="mobile-action-buttons">
                                                        <button
                                                            class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs transition-colors"
                                                            data-id="{{ $cat->id }}" data-name="{{ $cat->name }}">
                                                            <i class="fas fa-trash mr-1.5"></i>
                                                            <span class="hidden sm:inline">Delete</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Category Modal --}}
    <div id="addModal" class="modal-overlay">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Add New Category</h3>
                <button id="closeAddModal"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name *</label>
                    <input id="addName"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                        placeholder="Enter category name" autofocus>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            /
                        </div>
                        <input id="addSlug"
                            class="w-full pl-8 px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="auto-generated">
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Leave empty for auto-generation</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="addDesc"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none"
                        rows="3" placeholder="Optional description"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order</label>
                    <input id="addOrder" type="number" min="0" value="0"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select id="addStatus"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <button id="cancelAddModal"
                        class="flex-1 px-5 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl font-medium transition-colors">
                        Cancel
                    </button>
                    <button id="submitAddBtn"
                        class="flex-1 px-5 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Add Category
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content max-w-md" onclick="event.stopPropagation()">
            <div class="p-6 text-center">
                <div
                    class="mx-auto w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-2xl"></i>
                </div>

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Delete Category</h3>
                <p id="deleteText" class="text-gray-600 dark:text-gray-400 mb-6"></p>

                <div class="flex gap-3">
                    <button id="cancelDeleteModal"
                        class="flex-1 px-5 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-xl font-medium transition-colors">
                        Cancel
                    </button>
                    <button id="confirmDeleteBtn"
                        class="flex-1 px-5 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables
            let editBox = null;
            let deleteId = null;
            let deleteName = '';
            let isDragging = false;
            let isUpdatingOrder = false;

            // Toast Function
            function toast(message, type = 'success') {
                const toastWrap = document.getElementById('toastWrap');
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <span>${message}</span>
                    <button class="ml-4 text-white/80 hover:text-white" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                toastWrap.appendChild(toast);
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            }

            // Loading Overlay
            function showLoading() {
                document.getElementById('loadingOverlay').style.display = 'flex';
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').style.display = 'none';
            }

            // Slugify - FIXED version
            function slugify(text) {
                if (!text) return '';
                return text.toString()
                    .normalize('NFKD')
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
            }

            // Auto generate slug from name
            const addNameInput = document.getElementById('addName');
            const addSlugInput = document.getElementById('addSlug');

            if (addNameInput && addSlugInput) {
                let slugManuallyEdited = false;

                addNameInput.addEventListener('input', function() {
                    if (!slugManuallyEdited) {
                        const slug = slugify(this.value);
                        addSlugInput.value = slug;
                    }
                });

                addSlugInput.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        slugManuallyEdited = true;
                    }
                });

                addSlugInput.addEventListener('focus', function() {
                    if (!this.value.trim()) {
                        const name = addNameInput.value.trim();
                        if (name) {
                            this.value = slugify(name);
                        }
                    }
                });
            }

            // Inline Edit
            document.addEventListener('click', function(e) {
                if (isDragging) return;

                const cell = e.target.closest('.inline-edit');
                if (!cell) {
                    if (editBox && !editBox.contains(e.target)) {
                        editBox.remove();
                        editBox = null;
                    }
                    return;
                }

                if (e.target.closest('.modal-overlay') || e.target.closest('.delete-btn')) {
                    return;
                }

                const id = cell.dataset.id;
                const field = cell.dataset.field;
                const oldText = cell.querySelector('span').textContent.trim();
                const isDescription = field === 'description';
                const originalValue = oldText === 'No description' ? '' : oldText;
                const isSlug = field === 'slug';

                let editValue = originalValue;
                if (isSlug && editValue.startsWith('/')) {
                    editValue = editValue.substring(1);
                }

                if (editBox) {
                    editBox.remove();
                }

                editBox = document.createElement('div');
                editBox.className = 'edit-box';

                const input = isDescription ? document.createElement('textarea') : document.createElement(
                    'input');
                input.className =
                    'w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none';
                input.value = editValue;

                if (isDescription) {
                    input.rows = 4;
                    input.placeholder = 'Enter description...';
                } else if (isSlug) {
                    input.placeholder = 'Enter slug (without /)';
                } else {
                    input.placeholder = `Enter ${field}...`;
                }

                editBox.appendChild(input);
                document.body.appendChild(editBox);

                const rect = cell.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const boxHeight = isDescription ? 120 : 44;

                if (rect.bottom + boxHeight > viewportHeight - 20) {
                    editBox.style.top = (rect.top - boxHeight - 10) + 'px';
                } else {
                    editBox.style.top = (rect.bottom + 10) + 'px';
                }

                editBox.style.left = Math.max(10, rect.left) + 'px';
                editBox.style.maxWidth = (window.innerWidth - 20) + 'px';

                input.focus();
                input.select();

                const saveHandler = async () => {
                    let newValue = input.value.trim();
                    if (isSlug) {
                        newValue = newValue.replace(/^\//, '');
                    }

                    if ((isSlug && newValue === editValue) || (!isSlug && newValue ===
                            originalValue)) {
                        editBox.remove();
                        editBox = null;
                        return;
                    }

                    await saveInlineEdit(id, field, newValue, cell);
                    editBox.remove();
                    editBox = null;
                };

                input.addEventListener('keydown', function(ev) {
                    if (ev.key === 'Enter' && !isDescription) {
                        ev.preventDefault();
                        saveHandler();
                    }
                    if (ev.key === 'Escape') {
                        editBox.remove();
                        editBox = null;
                    }
                });

                input.addEventListener('blur', saveHandler);
            });

            // Save Inline Edit
            async function saveInlineEdit(id, field, value, cell) {
                try {
                    showLoading();
                    const response = await fetch("{{ route('admin.news-categories.update-inline') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            field,
                            value
                        })
                    });

                    const data = await response.json();
                    hideLoading();

                    if (!data.success) {
                        toast(data.message || 'Update failed', 'error');
                        return;
                    }

                    if (field === 'name') {
                        const nameSpan = cell.querySelector(`.name-${id}`);
                        const slugSpan = document.querySelector(`.slug-${id}`);
                        if (nameSpan) nameSpan.textContent = value;
                        if (slugSpan) slugSpan.textContent = '/' + (data.slug || slugify(value));
                    } else if (field === 'slug') {
                        const slugSpan = document.querySelector(`.slug-${id}`);
                        if (slugSpan) slugSpan.textContent = '/' + value;
                    } else if (field === 'description') {
                        const descSpan = cell.querySelector(`.desc-${id}`);
                        if (descSpan) descSpan.textContent = value || 'No description';
                    }

                    toast('Category updated successfully');
                } catch (error) {
                    hideLoading();
                    toast('Failed to update category', 'error');
                }
            }

            // Status Toggle
            document.addEventListener('click', function(e) {
                if (isDragging) return;

                const toggleBtn = e.target.closest('.status-toggle');
                if (!toggleBtn) return;

                e.stopPropagation();
                const id = toggleBtn.dataset.id;
                const statusSpan = document.querySelector(`.statusText-${id}`);
                const isActive = toggleBtn.dataset.active === '1';
                const newStatus = !isActive;

                toggleStatus(id, toggleBtn, statusSpan, newStatus);
            });

            async function toggleStatus(id, button, statusSpan, newStatus) {
                try {
                    showLoading();
                    const response = await fetch("{{ route('admin.news-categories.toggle-status') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: id,
                            is_active: newStatus ? 1 : 0
                        })
                    });

                    const data = await response.json();
                    hideLoading();

                    if (!data.success) {
                        toast(data.message || 'Failed to update status', 'error');
                        return;
                    }

                    button.classList.toggle('active', newStatus);
                    button.classList.toggle('inactive', !newStatus);
                    button.dataset.active = newStatus ? '1' : '0';

                    if (statusSpan) {
                        statusSpan.textContent = newStatus ? 'Active' : 'Inactive';
                        statusSpan.className =
                            `ml-2 text-xs font-medium ${newStatus ? 'text-green-600' : 'text-gray-600'}`;
                    }

                    toast(`Status updated to ${newStatus ? 'Active' : 'Inactive'}`);
                } catch (error) {
                    hideLoading();
                    toast('Failed to update status', 'error');
                }
            }

            // Initialize Sortable
            const tableBody = document.getElementById('tableBody');
            if (tableBody) {
                const sortable = new Sortable(tableBody, {
                    animation: 200,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-drag',
                    handle: '.drag-handle',
                    filter: '.no-drag',
                    preventOnFilter: false,

                    onStart: function() {
                        isDragging = true;
                        tableBody.classList.add('order-updating');
                    },

                    onEnd: function() {
                        isDragging = false;
                        tableBody.classList.remove('order-updating');

                        if (isUpdatingOrder) return;

                        isUpdatingOrder = true;
                        const orders = [];
                        document.querySelectorAll('.draggable-row').forEach((row, index) => {
                            const id = row.dataset.id;
                            const order = index + 1;
                            orders.push({
                                id: id,
                                order: order
                            });

                            const orderBadge = row.querySelector(`.order-${id}`);
                            if (orderBadge) {
                                orderBadge.textContent = order;
                            }
                        });

                        saveOrder(orders);
                    }
                });
            }

            // Save order without reload
            async function saveOrder(orders) {
                try {
                    const response = await fetch("{{ route('admin.news-categories.update-order') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            orders
                        })
                    });

                    const data = await response.json();
                    isUpdatingOrder = false;

                    if (data.success) {
                        toast('Order updated successfully');
                    } else {
                        toast(data.message || 'Failed to save order', 'error');
                    }
                } catch (error) {
                    isUpdatingOrder = false;
                    toast('Failed to save order', 'error');
                }
            }

            // Function to add new category to table
            function addCategoryToTable(category) {
                const tbody = document.getElementById('tableBody');
                if (!tbody) return;

                const newRow = document.createElement('tr');
                newRow.className = 'draggable-row hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors';
                newRow.dataset.id = category.id;

                newRow.innerHTML = `
                    <td class="p-4">
                        <div class="inline-edit cursor-pointer group" data-field="name" data-id="${category.id}">
                            <span class="name-${category.id} font-medium text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">
                                ${category.name}
                            </span>
                            <span class="ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-edit text-xs"></i>
                            </span>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="inline-edit cursor-pointer group" data-field="slug" data-id="${category.id}">
                            <span class="slug-${category.id} text-gray-600 dark:text-gray-400 group-hover:text-blue-600 transition-colors">
                                /${category.slug}
                            </span>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="inline-edit cursor-pointer group" data-field="description" data-id="${category.id}">
                            <span class="desc-${category.id} text-gray-600 dark:text-gray-400 truncate max-w-[200px] group-hover:text-blue-600 transition-colors">
                                ${category.description || 'No description'}
                            </span>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-grip-vertical drag-handle text-gray-400 hover:text-blue-500 transition-colors"></i>
                            <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/20 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold order-${category.id}">
                                ${category.order}
                            </span>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center">
                            <button type="button" class="status-toggle ${category.is_active ? 'active' : 'inactive'}" data-id="${category.id}" data-active="${category.is_active}" aria-label="Toggle status">
                            </button>
                            <span class="ml-2 text-xs font-medium statusText-${category.id} ${category.is_active ? 'text-green-600' : 'text-gray-600'}">
                                ${category.is_active ? 'Active' : 'Inactive'}
                            </span>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="flex justify-center">
                            <div class="mobile-action-buttons">
                                <button class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs transition-colors" data-id="${category.id}" data-name="${category.name}">
                                    <i class="fas fa-trash mr-1.5"></i>
                                    <span class="hidden sm:inline">Delete</span>
                                </button>
                            </div>
                        </div>
                    </td>
                `;

                tbody.appendChild(newRow);

                // Add event listeners untuk row baru
                addEventListenersToRow(newRow);

                // Reinitialize Sortable jika perlu
                if (typeof Sortable !== 'undefined') {
                    const newSortable = Sortable.get(tbody);
                    if (newSortable) {
                        newSortable.option('draggable', '.draggable-row');
                    }
                }
            }

            // Add event listeners to new row
            function addEventListenersToRow(row) {
                const deleteBtn = row.querySelector('.delete-btn');
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        deleteId = this.dataset.id;
                        deleteName = this.dataset.name;
                        document.getElementById('deleteText').textContent =
                            `Are you sure you want to delete "${deleteName}"? This action cannot be undone.`;
                        deleteModal.classList.add('active');
                    });
                }

                const statusToggle = row.querySelector('.status-toggle');
                if (statusToggle) {
                    statusToggle.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = this.dataset.id;
                        const statusSpan = document.querySelector(`.statusText-${id}`);
                        const isActive = this.dataset.active === '1';
                        const newStatus = !isActive;
                        toggleStatus(id, this, statusSpan, newStatus);
                    });
                }
            }

            // Modal Functions
            const addModal = document.getElementById('addModal');
            const deleteModal = document.getElementById('deleteModal');

            // Add Modal
            document.getElementById('openAddModal').addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('addName').value = '';
                document.getElementById('addSlug').value = '';
                document.getElementById('addDesc').value = '';
                document.getElementById('addOrder').value = '0';
                document.getElementById('addStatus').value = '1';
                if (typeof slugManuallyEdited !== 'undefined') {
                    slugManuallyEdited = false;
                }
                addModal.classList.add('active');
                setTimeout(() => document.getElementById('addName').focus(), 100);
            });

            document.getElementById('closeAddModal').addEventListener('click', function(e) {
                e.stopPropagation();
                addModal.classList.remove('active');
            });

            document.getElementById('cancelAddModal').addEventListener('click', function(e) {
                e.stopPropagation();
                addModal.classList.remove('active');
            });

            // Delete Modal
            document.addEventListener('click', function(e) {
                const deleteBtn = e.target.closest('.delete-btn');
                if (deleteBtn && !isDragging) {
                    e.stopPropagation();
                    deleteId = deleteBtn.dataset.id;
                    deleteName = deleteBtn.dataset.name;
                    document.getElementById('deleteText').textContent =
                        `Are you sure you want to delete "${deleteName}"? This action cannot be undone.`;
                    deleteModal.classList.add('active');
                }
            });

            document.getElementById('cancelDeleteModal').addEventListener('click', function(e) {
                e.stopPropagation();
                deleteModal.classList.remove('active');
            });

            // Close modals on overlay click
            [addModal, deleteModal].forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
            });

            // Submit Add (FIXED version)
            document.getElementById('submitAddBtn').addEventListener('click', async function(e) {
                e.preventDefault();
                e.stopPropagation();

                const name = document.getElementById('addName').value.trim();
                let slug = document.getElementById('addSlug').value.trim();
                const description = document.getElementById('addDesc').value.trim();
                const order = parseInt(document.getElementById('addOrder').value) || 0;
                const isActive = document.getElementById('addStatus').value;

                if (!name) {
                    toast('Please enter category name', 'error');
                    document.getElementById('addName').focus();
                    return;
                }

                // Auto-generate slug jika kosong
                if (!slug) {
                    slug = slugify(name);
                }

                // Debug log
                console.log('Submitting category:', {
                    name,
                    slug,
                    description,
                    order,
                    isActive
                });

                try {
                    showLoading();

                    // Gunakan FormData untuk mengirim data
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('name', name);
                    formData.append('slug', slug);
                    formData.append('description', description);
                    formData.append('order', order);
                    formData.append('is_active', isActive);

                    const response = await fetch("{{ route('admin.news-categories.store') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                    console.log('Response status:', response.status);

                    const data = await response.json();
                    console.log('Response data:', data);

                    hideLoading();

                    if (data.success) {
                        toast('Category created successfully');
                        addModal.classList.remove('active');

                        // Add new row to table tanpa reload
                        if (data.category) {
                            addCategoryToTable(data.category);
                        }
                    } else {
                        let errorMsg = data.message || 'Failed to create category';
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join(', ');
                        }
                        toast(errorMsg, 'error');
                    }
                } catch (error) {
                    hideLoading();
                    console.error('Error:', error);
                    toast('Failed to create category: ' + error.message, 'error');
                }
            });

            // Confirm Delete
            document.getElementById('confirmDeleteBtn').addEventListener('click', async function(e) {
                e.stopPropagation();
                if (!deleteId) return;

                try {
                    showLoading();

                    // Tambahkan CSRF token ke headers
                    const response = await fetch(`{{ url('admin/news-categories') }}/${deleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();
                    hideLoading();

                    if (data.success) {
                        toast('Category deleted successfully');
                        deleteModal.classList.remove('active');

                        // Remove row dari table
                        const row = document.querySelector(`.draggable-row[data-id="${deleteId}"]`);
                        if (row) {
                            row.remove();
                        }
                    } else {
                        toast(data.message || 'Failed to delete category', 'error');
                    }
                } catch (error) {
                    hideLoading();
                    toast('Failed to delete category: ' + error.message, 'error');
                }
            });

            // Close modals on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (addModal.classList.contains('active')) {
                        addModal.classList.remove('active');
                    }
                    if (deleteModal.classList.contains('active')) {
                        deleteModal.classList.remove('active');
                    }
                    if (editBox) {
                        editBox.remove();
                        editBox = null;
                    }
                }
            });
        });
    </script>
@endpush
