@extends('admin.layouts.app')

@section('title', 'News Management')
@section('subtitle', 'Manage all news articles')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-archived {
            background-color: #f3f4f6;
            color: #374151;
        }

        .table-hover tr:hover {
            background-color: #f9fafb;
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-4 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-90">Total News</p>
                    <h3 class="text-2xl font-bold">{{ $stats['total'] }}</h3>
                </div>
                <i class="fas fa-newspaper text-2xl opacity-80"></i>
            </div>
            <div class="mt-2 text-xs opacity-90">
                <i class="fas fa-chart-line mr-1"></i> All articles
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-4 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-90">Published</p>
                    <h3 class="text-2xl font-bold">{{ $stats['published'] }}</h3>
                </div>
                <i class="fas fa-check-circle text-2xl opacity-80"></i>
            </div>
            <div class="mt-2 text-xs opacity-90">
                <i class="fas fa-eye mr-1"></i> Visible to public
            </div>
        </div>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg p-4 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-90">Drafts</p>
                    <h3 class="text-2xl font-bold">{{ $stats['draft'] }}</h3>
                </div>
                <i class="fas fa-edit text-2xl opacity-80"></i>
            </div>
            <div class="mt-2 text-xs opacity-90">
                <i class="fas fa-clock mr-1"></i> Under review
            </div>
        </div>

        <div class="bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg p-4 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-90">Archived</p>
                    <h3 class="text-2xl font-bold">{{ $stats['archived'] }}</h3>
                </div>
                <i class="fas fa-archive text-2xl opacity-80"></i>
            </div>
            <div class="mt-2 text-xs opacity-90">
                <i class="fas fa-box mr-1"></i> Archived content
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header with Actions -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">All News Articles</h2>
                    <p class="text-gray-600 text-sm">Manage and organize your news content</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.news.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center transition duration-200">
                        <i class="fas fa-plus mr-2"></i> Create News Article
                    </a>

                    @if (request()->hasAny(['search', 'status', 'category', 'date_from', 'date_to']))
                        <a href="{{ route('admin.news.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium flex items-center transition duration-200">
                            <i class="fas fa-times mr-2"></i> Clear Filters
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('admin.news.index') }}"
                class="space-y-4 md:space-y-0 md:grid md:grid-cols-5 md:gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search news..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                        </option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <select name="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center transition duration-200">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Date Range Filter -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="text" id="date_from" name="date_from" value="{{ request('date_from') }}"
                        placeholder="Start date"
                        class="datepicker w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                    <input type="text" id="date_to" name="date_to" value="{{ request('date_to') }}"
                        placeholder="End date"
                        class="datepicker w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                </div>

                <div class="flex items-end">
                    <button type="button" onclick="applyDateFilter()"
                        class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        Apply Date Range
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="p-4 border-b border-gray-200 bg-yellow-50 hidden" id="bulkActionsContainer">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 font-medium" id="selectedCount">0 items selected</span>
                    <select id="bulkAction"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                        <option value="">Choose Action</option>
                        <option value="publish">Publish Selected</option>
                        <option value="draft">Move to Draft</option>
                        <option value="archive">Archive Selected</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button onclick="applyBulkAction()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        Apply
                    </button>
                </div>
                <button onclick="clearSelection()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i> Clear
                </button>
            </div>
        </div>

        <!-- News Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                            <input type="checkbox" id="selectAll"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($news as $item)
                        <tr class="table-hover hover:bg-gray-50 transition duration-150">
                            <!-- Checkbox -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" value="{{ $item->id }}"
                                    class="news-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>

                            <!-- Article -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($item->thumbnail_image)
                                            <img class="h-12 w-12 rounded-lg object-cover"
                                                src="{{ Storage::disk('s3')->url($item->thumbnail_image) }}"
                                                alt="{{ $item->title }}" loading="lazy"
                                                onerror="this.onerror=null;this.src='/images/no-image.png';">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('admin.news.edit', $item) }}" class="hover:text-blue-600">
                                                {{ Str::limit($item->title, 50) }}
                                            </a>
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit(strip_tags($item->excerpt), 70) }}
                                        </div>

                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="fas fa-user mr-1"></i> {{ $item->author ?? 'Admin' }}
                                        </div>
                                    </div>
                                </div>
                            </td>


                            <!-- Category -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->category)
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        {{ $item->category->name }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">Uncategorized</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="status-badge {{ $item->status == 'published' ? 'status-published' : ($item->status == 'draft' ? 'status-draft' : 'status-archived') }}">
                                    <i
                                        class="fas {{ $item->status == 'published' ? 'fa-check-circle' : ($item->status == 'draft' ? 'fa-edit' : 'fa-archive') }} mr-1"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                                @if ($item->published_at)
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $item->published_at->format('M d, Y') }}
                                    </div>
                                @endif
                            </td>

                            <!-- Views -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-eye text-gray-400 mr-2"></i>
                                    <span class="font-medium">{{ number_format($item->views ?? 0) }}</span>
                                    @if (($item->likes ?? 0) > 0)
                                        <span class="ml-4">
                                            <i class="fas fa-heart text-red-400 mr-1"></i>
                                            <span>{{ $item->likes }}</span>
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Created -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.news.show', $item) }}"
                                        class="text-blue-600 hover:text-blue-900 action-btn" title="Preview">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.news.edit', $item) }}"
                                        class="text-green-600 hover:text-green-900 action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Status Toggle Dropdown -->
                                    <div class="relative inline-block text-left">
                                        <button type="button" class="text-purple-600 hover:text-purple-900 action-btn"
                                            title="Change Status" onclick="toggleStatusDropdown({{ $item->id }})">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                        <div id="statusDropdown-{{ $item->id }}"
                                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                            <div class="py-1">
                                                <button onclick="updateStatus({{ $item->id }}, 'published')"
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-green-50 {{ $item->status == 'published' ? 'text-green-600 bg-green-50' : 'text-gray-700' }}">
                                                    <i class="fas fa-check-circle mr-2"></i> Publish
                                                </button>
                                                <button onclick="updateStatus({{ $item->id }}, 'draft')"
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-yellow-50 {{ $item->status == 'draft' ? 'text-yellow-600 bg-yellow-50' : 'text-gray-700' }}">
                                                    <i class="fas fa-edit mr-2"></i> Draft
                                                </button>
                                                <button onclick="updateStatus({{ $item->id }}, 'archived')"
                                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50 {{ $item->status == 'archived' ? 'text-gray-600 bg-gray-50' : 'text-gray-700' }}">
                                                    <i class="fas fa-archive mr-2"></i> Archive
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this news article?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 action-btn"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="mb-4">
                                    <i class="fas fa-newspaper text-4xl text-gray-300"></i>
                                </div>
                                <p class="text-lg font-medium">No news articles found</p>
                                <p class="mt-2">Get started by creating your first news article.</p>
                                <a href="{{ route('admin.news.create') }}"
                                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                                    Create News Article
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($news->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $news->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialize date pickers
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('.datepicker', {
                dateFormat: 'Y-m-d',
            });
        });

        // Apply date filter
        function applyDateFilter() {
            const dateFrom = document.getElementById('date_from').value;
            const dateTo = document.getElementById('date_to').value;
            const url = new URL(window.location.href);

            if (dateFrom) {
                url.searchParams.set('date_from', dateFrom);
            } else {
                url.searchParams.delete('date_from');
            }

            if (dateTo) {
                url.searchParams.set('date_to', dateTo);
            } else {
                url.searchParams.delete('date_to');
            }

            window.location.href = url.toString();
        }

        // Toggle status dropdown
        function toggleStatusDropdown(newsId) {
            const dropdown = document.getElementById('statusDropdown-' + newsId);
            dropdown.classList.toggle('hidden');

            // Close other dropdowns
            document.querySelectorAll('[id^="statusDropdown-"]').forEach(el => {
                if (el.id !== 'statusDropdown-' + newsId) {
                    el.classList.add('hidden');
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function closeDropdown(e) {
                if (!dropdown.contains(e.target) && !e.target.closest('button[onclick*="toggleStatusDropdown"]')) {
                    dropdown.classList.add('hidden');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        }

        // Update status
        function updateStatus(newsId, status) {
            if (!confirm(`Are you sure you want to change status to ${status}?`)) {
                return;
            }

            fetch(`{{ url('admin/news') }}/${newsId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status,
                        _method: 'PATCH'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Error updating status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating status');
                });
        }

        // Bulk actions
        const bulkActionsContainer = document.getElementById('bulkActionsContainer');
        const selectAllCheckbox = document.getElementById('selectAll');
        const newsCheckboxes = document.querySelectorAll('.news-checkbox');
        const selectedCount = document.getElementById('selectedCount');

        // Select all functionality
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                newsCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });
        }

        // Update individual checkbox
        newsCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActions);
        });

        // Update bulk actions UI
        function updateBulkActions() {
            const selected = document.querySelectorAll('.news-checkbox:checked');
            const count = selected.length;

            if (selectedCount) {
                selectedCount.textContent = `${count} item${count !== 1 ? 's' : ''} selected`;
            }

            if (count > 0 && bulkActionsContainer) {
                bulkActionsContainer.classList.remove('hidden');
            } else if (bulkActionsContainer) {
                bulkActionsContainer.classList.add('hidden');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = false;
                }
            }
        }

        // Apply bulk action
        function applyBulkAction() {
            const action = document.getElementById('bulkAction').value;
            const selected = document.querySelectorAll('.news-checkbox:checked');
            const ids = Array.from(selected).map(cb => cb.value);

            if (!action) {
                alert('Please select an action');
                return;
            }

            if (ids.length === 0) {
                alert('Please select at least one item');
                return;
            }

            if (!confirm(`Are you sure you want to ${action} ${ids.length} item(s)?`)) {
                return;
            }

            // Create form for bulk action
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.news.bulk-action') }}';

            // CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Action
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);

            // IDs
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }

        // Clear selection
        function clearSelection() {
            newsCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateBulkActions();
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="statusDropdown-"]') && !e.target.closest(
                    'button[onclick*="toggleStatusDropdown"]')) {
                document.querySelectorAll('[id^="statusDropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>
@endpush
