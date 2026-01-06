@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit CSR Program</h1>
        <p class="text-sm text-gray-500">Update data program CSR</p>
    </div>

    <form method="POST"
          action="{{ route('admin.csr.update', $csr->id) }}"
          enctype="multipart/form-data"
          class="bg-white shadow rounded-lg p-6 space-y-6">

        @csrf
        @method('PUT')

        {{-- TITLE --}}
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $csr->title) }}"
                   class="w-full border rounded px-3 py-2">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- EXCERPT --}}
        <div>
            <label class="block text-sm font-medium mb-1">Excerpt</label>
            <textarea name="excerpt"
                      rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('excerpt', $csr->excerpt) }}</textarea>
        </div>

        {{-- CONTENT --}}
        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea name="content"
                      rows="6"
                      class="w-full border rounded px-3 py-2">{{ old('content', $csr->content) }}</textarea>
        </div>

        {{-- CATEGORY --}}
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category" class="w-full border rounded px-3 py-2">
                @foreach ($categories as $key => $label)
                    <option value="{{ $key }}"
                        @selected(old('category', $csr->category) === $key)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- LOCATION --}}
        <div>
            <label class="block text-sm font-medium mb-1">Location</label>
            <input type="text"
                   name="location"
                   value="{{ old('location', $csr->location) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        {{-- YEAR --}}
        <div>
            <label class="block text-sm font-medium mb-1">Year</label>
            <select name="year" class="w-full border rounded px-3 py-2">
                @foreach ($years as $year)
                    <option value="{{ $year }}"
                        @selected(old('year', $csr->year) == $year)>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- BUDGET --}}
        <div>
            <label class="block text-sm font-medium mb-1">Budget</label>
            <input type="number"
                   name="budget"
                   value="{{ old('budget', $csr->budget) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="draft" @selected($csr->status === 'draft')>Draft</option>
                <option value="published" @selected($csr->status === 'published')>Published</option>
                <option value="archived" @selected($csr->status === 'archived')>Archived</option>
            </select>
        </div>

        {{-- FEATURED IMAGE --}}
        <div>
            <label class="block text-sm font-medium mb-2">Featured Image</label>

            @if ($csr->featured_image)
                <img src="{{ Storage::url($csr->featured_image) }}"
                     class="w-48 mb-2 rounded border">
            @endif

            <input type="file" name="featured_image" class="block w-full">
        </div>

        {{-- IMPACT METRICS --}}
        <div>
            <label class="block text-sm font-medium mb-2">Impact Metrics</label>

            @php
                $metrics = old('impact_metrics', json_decode($csr->impact_metrics, true) ?? []);
            @endphp

            @foreach ($metrics as $i => $metric)
                <div class="flex gap-2 mb-2">
                    <input name="impact_metrics[{{ $i }}][name]"
                           value="{{ $metric['name'] ?? '' }}"
                           placeholder="Metric"
                           class="border px-2 py-1 rounded w-1/3">

                    <input name="impact_metrics[{{ $i }}][value]"
                           value="{{ $metric['value'] ?? '' }}"
                           placeholder="Value"
                           class="border px-2 py-1 rounded w-1/3">

                    <input name="impact_metrics[{{ $i }}][unit]"
                           value="{{ $metric['unit'] ?? '' }}"
                           placeholder="Unit"
                           class="border px-2 py-1 rounded w-1/3">
                </div>
            @endforeach
        </div>

        {{-- ACTIONS --}}
        <div class="flex justify-between pt-4">
            <a href="{{ route('admin.csr.index') }}"
               class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
                Back
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update CSR
            </button>
        </div>

    </form>
</div>
@endsection
