@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Welcome back, ' . Auth::user()->name)

@section('content')

    {{-- ===================== STATS ===================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

        <x-stat-card label="Visitors" value="2.8K" color="blue">
            <x-slot:icon>
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m6-4a4 4 0 10-8 0 4 4 0 008 0z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card label="News" :value="\App\Models\News::count()" color="green">
            <x-slot:icon>
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M7 7h10M7 11h10M7 15h6" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card label="CSR" :value="\App\Models\CSR::count()" color="purple">
            <x-slot:icon>
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card label="Messages" value="3" color="red">
            <x-slot:icon>
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

    </div>

    {{-- ===================== CHART ===================== --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-6">
        <h3 class="font-semibold text-gray-800 mb-4">Traffic Overview</h3>
        <canvas id="trafficChart" height="100"></canvas>
    </div>

    {{-- ===================== SYSTEM STATUS ===================== --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
        <x-progress-bar label="Storage Usage" value="78" color="blue" />
        <x-progress-bar label="Database" value="42" color="green" />
        <x-progress-bar label="Memory Usage" value="65" color="purple" />
    </div>

@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('trafficChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Visitors',
                    data: [245, 312, 398, 287, 345, 210, 187],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                    barThickness: 28
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
