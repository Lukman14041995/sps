@extends('admin.layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit CSR Program</h1>
                        <p class="text-gray-600 mt-1">Update your corporate social responsibility initiative</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.csr.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Container - SINGLE PAGE TANPA MULTI-STEP -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <form id="editCsrForm" action="{{ route('admin.csr.update', $csr->id) }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="p-8">
                        <!-- Basic Information -->
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Basic Information
                            </h3>

                            <!-- Title -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Program Title *
                                </label>
                                <input type="text" name="title" value="{{ old('title', $csr->title) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                    placeholder="Enter program title">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Category *
                                </label>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach (['social' => 'Social', 'environment' => 'Environment', 'quality' => 'Quality'] as $key => $label)
                                        @php
                                            $colors = [
                                                'social' => '#3B82F6',
                                                'environment' => '#10B981',
                                                'quality' => '#F59E0B',
                                            ];
                                            $color = $colors[$key] ?? '#6B7280';
                                        @endphp
                                        <label class="relative">
                                            <input type="radio" name="category" value="{{ $key }}"
                                                class="sr-only peer"
                                                {{ old('category', $csr->category) == $key ? 'checked' : '' }}>
                                            <div
                                                class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-2"
                                                    style="background-color: {{ $color }}20">
                                                    @if ($key == 'social')
                                                        <svg class="w-5 h-5" style="color: {{ $color }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    @elseif($key == 'environment')
                                                        <svg class="w-5 h-5" style="color: {{ $color }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4 4 0 003 15z" />
                                                        </svg>
                                                    @elseif($key == 'quality')
                                                        <svg class="w-5 h-5" style="color: {{ $color }}"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-medium">{{ $label }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('category')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Short Description
                                </label>
                                <textarea name="excerpt" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                    placeholder="Brief summary of the program">{{ old('excerpt', $csr->excerpt) }}</textarea>
                                @error('excerpt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Program Description *
                                </label>
                                <textarea name="content" rows="6"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                    placeholder="Detailed description of the program, objectives, and impact">{{ old('content', $csr->content) }}</textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Program Details -->
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Program Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Location -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Location
                                    </label>
                                    <input type="text" name="location" value="{{ old('location', $csr->location) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="City, Region">
                                    @error('location')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
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
                                            <option value="{{ $i }}"
                                                {{ old('year', $csr->year) == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Duration
                                    </label>
                                    <input type="text" name="duration" value="{{ old('duration', $csr->duration) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="e.g., 6 months, 1 year">
                                    @error('duration')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Beneficiaries -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Beneficiaries Count
                                    </label>
                                    <input type="number" name="beneficiaries_count"
                                        value="{{ old('beneficiaries_count', $csr->beneficiaries_count) }}"
                                        min="0"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="Number of people impacted">
                                    @error('beneficiaries_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Budget -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Budget (in Rupiah) <span class="text-gray-500 text-xs">(Optional)</span>
                                    </label>
                                    <input type="number" name="budget" value="{{ old('budget', $csr->budget) }}"
                                        min="0" step="100000"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="Total program budget">
                                    @error('budget')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Partners -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Partners
                                    </label>
                                    <input type="text" name="partners" value="{{ old('partners', $csr->partners) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="Organization names separated by comma">
                                    @error('partners')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Media & Results -->
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Media & Results
                            </h3>

                            <!-- Featured Image -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Featured Image
                                </label>

                                @if ($csr->featured_image)
                                    <div class="mb-4 flex items-center gap-4">
                                        <img src="{{ $csr->featured_image_url }}" alt="Current featured image"
                                            class="w-48 h-32 object-cover rounded-lg shadow-sm">

                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="remove_featured_image" value="1"
                                                    class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                                <span class="ml-2 text-sm text-red-600">Remove current image</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <input type="file" name="featured_image" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 1200x630px • Max: 2MB</p>
                                @error('featured_image')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Gallery Images <span class="text-gray-500 text-xs">(Optional)</span>
                                </label>

                                @php
                                    $galleryImages = [];
                                    if ($csr->gallery_images) {
                                        if (is_string($csr->gallery_images)) {
                                            $decoded = json_decode($csr->gallery_images, true);
                                            $galleryImages = is_array($decoded) ? $decoded : [];
                                        } elseif (is_array($csr->gallery_images)) {
                                            $galleryImages = $csr->gallery_images;
                                        }
                                    }
                                @endphp

                                @if (count($galleryImages) > 0)
                                    <div class="mb-6">
                                        <p class="text-sm text-gray-600 mb-3">Current Gallery Images:</p>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                                            @foreach ($galleryImages as $index => $image)
                                                @if (is_string($image))
                                                    <div class="relative group">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            alt="Gallery image {{ $index + 1 }}"
                                                            class="w-full h-32 object-cover rounded-lg shadow-sm">

                                                        <div class="absolute top-2 right-2">
                                                            <label class="inline-flex items-center">
                                                                <input type="checkbox" name="remove_gallery_images[]"
                                                                    value="{{ $image }}"
                                                                    class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                                                <span class="sr-only">Remove image</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <input type="file" name="gallery_images[]" accept="image/*" multiple
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                                <p class="mt-1 text-xs text-gray-500">Multiple images allowed • Max: 2MB per image</p>
                                @error('gallery_images.*')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Achievements & Testimonials -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Key Achievements
                                    </label>
                                    <textarea name="achievements" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                        placeholder="Notable accomplishments and outcomes">{{ old('achievements', $csr->achievements) }}</textarea>
                                    @error('achievements')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Testimonials
                                    </label>
                                    <textarea name="testimonials" rows="4"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                        placeholder="Quotes or feedback from beneficiaries">{{ old('testimonials', $csr->testimonials) }}</textarea>
                                    @error('testimonials')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Impact Metrics -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Impact Metrics (Optional)
                                </label>

                                <div id="impactMetricsContainer" class="space-y-4">
                                    @php
                                        $impactMetrics = [];
                                        if ($csr->impact_metrics) {
                                            if (is_string($csr->impact_metrics)) {
                                                $decoded = json_decode($csr->impact_metrics, true);
                                                $impactMetrics = is_array($decoded) ? $decoded : [];
                                            } elseif (is_array($csr->impact_metrics)) {
                                                $impactMetrics = $csr->impact_metrics;
                                            }
                                        }

                                        if (empty($impactMetrics)) {
                                            $impactMetrics = [['name' => '', 'value' => '', 'unit' => '']];
                                        }
                                    @endphp

                                    @foreach ($impactMetrics as $index => $metric)
                                        <div
                                            class="impact-metric-item flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                                            <div class="flex-1">
                                                <input type="text" name="impact_metrics[{{ $index }}][name]"
                                                    value="{{ $metric['name'] ?? '' }}" placeholder="Metric name"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <div class="w-32">
                                                <input type="text" name="impact_metrics[{{ $index }}][value]"
                                                    value="{{ $metric['value'] ?? '' }}" placeholder="Value"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <div class="w-24">
                                                <input type="text" name="impact_metrics[{{ $index }}][unit]"
                                                    value="{{ $metric['unit'] ?? '' }}" placeholder="Unit"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            @if (!$loop->first)
                                                <button type="button" onclick="removeImpactMetric(this)"
                                                    class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                                    Remove
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addImpactMetric()"
                                    class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    + Add Metric
                                </button>
                            </div>

                            <!-- Team Members -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Team Members (Optional)
                                </label>

                                <div id="teamMembersContainer" class="space-y-4">
                                    @php
                                        $teamMembers = [];
                                        if ($csr->team_members) {
                                            if (is_string($csr->team_members)) {
                                                $decoded = json_decode($csr->team_members, true);
                                                $teamMembers = is_array($decoded) ? $decoded : [];
                                            } elseif (is_array($csr->team_members)) {
                                                $teamMembers = $csr->team_members;
                                            }
                                        }

                                        if (empty($teamMembers)) {
                                            $teamMembers = [['name' => '', 'role' => '']];
                                        }
                                    @endphp

                                    @foreach ($teamMembers as $index => $member)
                                        <div
                                            class="team-member-item flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                                            <div class="flex-1">
                                                <input type="text" name="team_members[{{ $index }}][name]"
                                                    value="{{ $member['name'] ?? '' }}" placeholder="Name"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <div class="flex-1">
                                                <input type="text" name="team_members[{{ $index }}][role]"
                                                    value="{{ $member['role'] ?? '' }}" placeholder="Role"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            @if (!$loop->first)
                                                <button type="button" onclick="removeTeamMember(this)"
                                                    class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                                    Remove
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addTeamMember()"
                                    class="mt-3 text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    + Add Member
                                </button>
                            </div>
                        </div>

                        <!-- Publishing Options -->
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Publishing
                                Options</h3>

                            <!-- Status -->
                            <div class="mb-8">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Status *
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <label class="relative">
                                        <input type="radio" name="status" value="draft" id="status_draft"
                                            {{ old('status', $csr->status) == 'draft' ? 'checked' : '' }}
                                            class="sr-only peer">
                                        <div
                                            class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-yellow-300 peer-checked:border-yellow-500 peer-checked:bg-yellow-50">
                                            <svg class="w-8 h-8 text-gray-400 peer-checked:text-yellow-500 mb-3"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="text-sm font-medium peer-checked:text-yellow-700">Draft</span>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Save as draft for later
                                                editing</p>
                                        </div>
                                    </label>
                                    <label class="relative">
                                        <input type="radio" name="status" value="published" id="status_published"
                                            {{ old('status', $csr->status) == 'published' ? 'checked' : '' }}
                                            class="sr-only peer">
                                        <div
                                            class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-green-300 peer-checked:border-green-500 peer-checked:bg-green-50">
                                            <svg class="w-8 h-8 text-gray-400 peer-checked:text-green-500 mb-3"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm font-medium peer-checked:text-green-700">Publish</span>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Make program publicly visible
                                            </p>
                                        </div>
                                    </label>
                                    <label class="relative">
                                        <input type="radio" name="status" value="archived" id="status_archived"
                                            {{ old('status', $csr->status) == 'archived' ? 'checked' : '' }}
                                            class="sr-only peer">
                                        <div
                                            class="flex flex-col items-center p-6 border-2 border-gray-200 rounded-xl cursor-pointer transition duration-200 hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                            <svg class="w-8 h-8 text-gray-400 peer-checked:text-blue-500 mb-3"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                            <span class="text-sm font-medium peer-checked:text-blue-700">Archive</span>
                                            <p class="text-xs text-gray-500 mt-1 text-center">Move to archived programs</p>
                                        </div>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SEO Fields -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Meta Title (for SEO)
                                    </label>
                                    <input type="text" name="meta_title"
                                        value="{{ old('meta_title', $csr->meta_title) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="SEO title for search engines">
                                    @error('meta_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Meta Description (for SEO)
                                    </label>
                                    <textarea name="meta_description" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 resize-none"
                                        placeholder="Brief description for search results">{{ old('meta_description', $csr->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Meta Keywords
                                    </label>
                                    <input type="text" name="meta_keywords"
                                        value="{{ old('meta_keywords', $csr->meta_keywords) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200"
                                        placeholder="Keywords separated by comma">
                                    @error('meta_keywords')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 px-8 py-6 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <a href="{{ route('admin.csr.index') }}"
                                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                    ← Cancel
                                </a>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" id="saveAsDraftBtn"
                                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl font-medium transition duration-200">
                                    Save as Draft
                                </button>
                                <button type="submit" id="submitBtn"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-200 shadow-md hover:shadow-lg">
                                    Update Program
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
        let impactMetricCount = {{ count($impactMetrics ?? []) }};
        let teamMemberCount = {{ count($teamMembers ?? []) }};

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            setupSaveAsDraft();
            setupFormValidation();

            console.log('Form ready for submission');
        });

        // Setup save as draft button
        function setupSaveAsDraft() {
            const saveDraftBtn = document.getElementById('saveAsDraftBtn');
            if (saveDraftBtn) {
                saveDraftBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Save as Draft clicked');

                    // Set status ke draft
                    const draftRadio = document.getElementById('status_draft');
                    if (draftRadio) {
                        draftRadio.checked = true;
                        console.log('Status set to draft');
                    }

                    // Validasi form sebelum submit
                    if (validateForm()) {
                        console.log('Form validated, submitting...');
                        document.getElementById('editCsrForm').submit();
                    }
                });
            }
        }

        // Setup form validation
        function setupFormValidation() {
            const form = document.getElementById('editCsrForm');
            if (form) {
                console.log('Form validation setup complete');

                form.addEventListener('submit', function(e) {
                    console.log('Form submit triggered');

                    if (!validateForm()) {
                        e.preventDefault();
                        console.log('Form validation failed');
                        return false;
                    }

                    console.log('Form validation passed');
                    return true;
                });
            }
        }

        // Validasi form
        function validateForm() {
            console.log('Validating form...');

            const title = document.querySelector('input[name="title"]').value.trim();
            const content = document.querySelector('textarea[name="content"]').value.trim();
            const category = document.querySelector('input[name="category"]:checked');
            const status = document.querySelector('input[name="status"]:checked');

            let errors = [];

            if (!title) {
                errors.push('Please enter program title');
            }
            if (!category) {
                errors.push('Please select a category');
            }
            if (!content) {
                errors.push('Please enter program description');
            }
            if (!status) {
                errors.push('Please select a status (Draft, Publish, or Archive)');
            }

            // Validasi tambahan untuk beneficiaries count
            const beneficiaries = document.querySelector('input[name="beneficiaries_count"]');
            if (beneficiaries && beneficiaries.value && beneficiaries.value < 0) {
                errors.push('Beneficiaries count cannot be negative');
            }

            // Validasi budget jika diisi
            const budget = document.querySelector('input[name="budget"]');
            if (budget && budget.value && budget.value < 0) {
                errors.push('Budget cannot be negative');
            }

            if (errors.length > 0) {
                alert(errors.join('\n'));
                console.log('Validation errors:', errors);
                return false;
            }

            console.log('Form validation passed');
            return true;
        }

        // Dynamic fields untuk impact metrics
        function addImpactMetric() {
            const container = document.getElementById('impactMetricsContainer');
            const newItem = document.createElement('div');
            newItem.className = 'impact-metric-item flex flex-col sm:flex-row gap-3 items-start sm:items-center';
            newItem.innerHTML = `
            <div class="flex-1">
                <input type="text" name="impact_metrics[${impactMetricCount}][name]" 
                    placeholder="Metric name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="w-32">
                <input type="text" name="impact_metrics[${impactMetricCount}][value]"
                    placeholder="Value"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="w-24">
                <input type="text" name="impact_metrics[${impactMetricCount}][unit]"
                    placeholder="Unit"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="button" onclick="removeImpactMetric(this)"
                class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                Remove
            </button>
        `;
            container.appendChild(newItem);
            impactMetricCount++;

            // Update tombol Add Metric
            const addButton = container.nextElementSibling;
            if (addButton && addButton.textContent.includes('Add Metric')) {
                addButton.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }

        function removeImpactMetric(button) {
            button.closest('.impact-metric-item').remove();
        }

        // Dynamic fields untuk team members
        function addTeamMember() {
            const container = document.getElementById('teamMembersContainer');
            const newItem = document.createElement('div');
            newItem.className = 'team-member-item flex flex-col sm:flex-row gap-3 items-start sm:items-center';
            newItem.innerHTML = `
            <div class="flex-1">
                <input type="text" name="team_members[${teamMemberCount}][name]" 
                    placeholder="Name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex-1">
                <input type="text" name="team_members[${teamMemberCount}][role]"
                    placeholder="Role"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="button" onclick="removeTeamMember(this)"
                class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                Remove
            </button>
        `;
            container.appendChild(newItem);
            teamMemberCount++;

            // Update tombol Add Member
            const addButton = container.nextElementSibling;
            if (addButton && addButton.textContent.includes('Add Member')) {
                addButton.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }

        function removeTeamMember(button) {
            button.closest('.team-member-item').remove();
        }
    </script>
@endpush

@push('styles')
    <style>
        .impact-metric-item,
        .team-member-item {
            padding: 1rem;
            background-color: #f9fafb;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
