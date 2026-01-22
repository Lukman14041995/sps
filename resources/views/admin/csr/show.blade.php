@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Breadcrumb --}}
        <nav class="text-sm mb-4">
            <a href="{{ route('admin.csr.index') }}" class="text-blue-600 hover:underline">CSR Programs</a> /
            <span class="text-gray-500">{{ $csr->title }}</span>
        </nav>

        {{-- Title & Status --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">{{ $csr->title }}</h1>
            <span
                class="px-3 py-1 rounded-full text-sm font-medium
            @if ($csr->status === 'published') bg-green-100 text-green-800
            @elseif($csr->status === 'draft') bg-yellow-100 text-yellow-800
            @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($csr->status) }}
            </span>
        </div>

        {{-- Featured Image --}}
        @if ($csr->featured_image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $csr->featured_image) }}" alt="{{ $csr->title }}"
                    class="w-full max-w-3xl h-auto rounded-lg border border-gray-300">

            </div>
        @endif

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <strong>Category:</strong> {{ $csr->category_name ?? ucfirst($csr->category) }}
            </div>
            <div>
                <strong>Location:</strong> {{ $csr->location }}
            </div>
            <div>
                <strong>Year:</strong> {{ $csr->year }}
            </div>
            <div>
                <strong>Duration:</strong> {{ $csr->duration }}
            </div>
            <div>
                <strong>Beneficiaries:</strong> {{ $csr->beneficiaries_count }}
            </div>
            <div>
                <strong>Budget:</strong> ${{ number_format($csr->budget, 2) }}
            </div>
            <div>
                <strong>Partners:</strong> {{ $csr->partners ?? '-' }}
            </div>
        </div>

        {{-- Excerpt & Content --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Program Summary</h2>
            <p class="text-gray-700">{{ $csr->excerpt }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Program Description</h2>
            <div class="prose max-w-none">{!! $csr->content !!}</div>
        </div>

        {{-- Impact Metrics --}}
        @if ($csr->impact_metrics && count($csr->impact_metrics) > 0)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Impact Metrics</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($csr->impact_metrics as $metric)
                        <div class="border p-3 rounded-lg bg-gray-50">
                            <strong>{{ $metric['name'] ?? '-' }}</strong>
                            <div>{{ $metric['value'] ?? '-' }} {{ $metric['unit'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Team Members --}}
        @if ($csr->team_members && count($csr->team_members) > 0)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Team Members</h2>
                <ul class="list-disc pl-5">
                    @foreach ($csr->team_members as $member)
                        <li>{{ $member['name'] ?? '-' }} - {{ $member['role'] ?? '-' }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Gallery --}}
        @if ($csr->gallery_images && count($csr->gallery_images) > 0)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Gallery</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($csr->gallery_images as $image)
                        <div class="rounded overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image"
                                class="w-full h-48 object-cover">

                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Achievements & Testimonials --}}
        @if ($csr->achievements)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Achievements</h2>
                <p>{{ $csr->achievements }}</p>
            </div>
        @endif

        @if ($csr->testimonials)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Testimonials</h2>
                <p>{{ $csr->testimonials }}</p>
            </div>
        @endif

        {{-- Meta Info --}}
        <div class="text-sm text-gray-500 mt-8 border-t pt-4">
            Created by: {{ $csr->creator->name ?? 'N/A' }} |
            Updated by: {{ $csr->updater->name ?? 'N/A' }} |
            Last updated: {{ $csr->updated_at->format('d M Y H:i') }}
        </div>

        {{-- Back Button --}}
        <div class="mt-6">
            <a href="{{ route('admin.csr.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Back to
                List</a>
        </div>

    </div>
@endsection
