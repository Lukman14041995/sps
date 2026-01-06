@extends('admin.layouts.app')

@section('title', $career->position . ' - Career Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $career->position }}</h1>
            </div>
            <p class="text-gray-600">Detail lowongan kerja</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.career.edit', $career) }}"
                class="px-4 py-2.5 border border-blue-300 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition-colors duration-200 font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.career.index') }}"
                class="px-4 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Basic Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h3>
                
                <div class="space-y-6">
                    <!-- Description -->
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Job Description</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 whitespace-pre-line">{{ $career->description }}</p>
                        </div>
                    </div>
                    
                    <!-- Requirements -->
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Requirements</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-600 whitespace-pre-line">{{ $career->requirements }}</p>
                        </div>
                    </div>
                    
                    <!-- Benefits -->
                    @if($career->benefits && count($career->benefits) > 0)
                    <div>
                        <h4 class="font-medium text-gray-700 mb-2">Benefits</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($career->benefits as $benefit)
                                    <li class="text-gray-600">{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Details Card -->
        <div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Position Details</h3>
                
                <div class="space-y-4">
                    <!-- Status Badge -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Status</span>
                        @if ($career->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                Inactive
                            </span>
                        @endif
                    </div>
                    
                    <!-- Department -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Department</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->department }}</span>
                    </div>
                    
                    <!-- Employment Type -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Employment Type</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->employment_type_label }}</span>
                    </div>
                    
                    <!-- Location -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Location</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->location }}</span>
                    </div>
                    
                    <!-- Salary -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Salary Range</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->salary_range }}</span>
                    </div>
                    
                    <!-- Vacancies -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Vacancies</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->vacancies }} position(s)</span>
                    </div>
                    
                    <!-- Experience -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Experience Required</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->experience_required ?? '0' }} years</span>
                    </div>
                    
                    <!-- Application Deadline -->
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Application Deadline</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $career->application_deadline->format('M d, Y') }}</span>
                    </div>
                    
                    <!-- Days Left -->
                    @php
                        $daysLeft = now()->diffInDays($career->application_deadline, false);
                    @endphp
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-500">Days Left</span>
                        <span class="text-sm font-semibold {{ $daysLeft > 7 ? 'text-green-600' : ($daysLeft > 0 ? 'text-amber-600' : 'text-red-600') }}">
                            @if($daysLeft > 0)
                                {{ $daysLeft }} days
                            @else
                                Closed
                            @endif
                        </span>
                    </div>
                </div>
                
                <!-- Meta Information -->
                <div class="pt-6 mt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Meta Information</h4>
                    <div class="space-y-1 text-sm text-gray-500">
                        <p>Created: {{ $career->created_at->format('M d, Y H:i') }}</p>
                        <p>Last Updated: {{ $career->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="pt-6 mt-6 border-t border-gray-200">
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('admin.career.edit', $career) }}"
                            class="w-full text-center px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Position
                        </a>
                        
                        <form action="{{ route('admin.career.destroy', $career) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this position? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-center px-4 py-2.5 border border-red-300 bg-red-50 text-red-700 rounded-xl hover:bg-red-100 transition-colors duration-200 font-medium flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Position
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection