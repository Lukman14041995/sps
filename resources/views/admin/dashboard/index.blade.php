@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('subtitle')
    Welcome back, {{ Auth::user()->name }}! Here's what's happening today.

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <!-- Visitors Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Website Visitors</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">2,847</h3>
                </div>
                <div class="bg-indigo-50 p-3 rounded-lg">
                    <i class="fas fa-users text-indigo-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 24%
                </span>
                <span class="text-gray-500 ml-2">from last week</span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Today: 312</span>
                    <span>This week: 1,428</span>
                </div>
            </div>
        </div>
        <a href="#" class="block bg-gray-50 hover:bg-gray-100 text-center py-3 text-gray-700 font-medium border-t border-gray-200">
            View Analytics <i class="fas fa-chart-line ml-2"></i>
        </a>
    </div>

    <!-- News Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total News</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">42</h3>
                </div>
                <div class="bg-blue-50 p-3 rounded-lg">
                    <i class="fas fa-newspaper text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 12%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
        
    </div>

    <!-- CSR Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">CSR Programs</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">18</h3>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <i class="fas fa-hands-helping text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 8%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
        <a href="{{ route('admin.csr.index') }}" class="block bg-gray-50 hover:bg-gray-100 text-center py-3 text-gray-700 font-medium border-t border-gray-200">
            View CSR Programs <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Career Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Job Openings</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">7</h3>
                </div>
                <div class="bg-purple-50 p-3 rounded-lg">
                    <i class="fas fa-briefcase text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-500 flex items-center">
                    <i class="fas fa-arrow-down mr-1"></i> 3%
                </span>
                <span class="text-gray-500 ml-2">from last month</span>
            </div>
        </div>
        <a href="{{ route('admin.career.index') }}" class="block bg-gray-50 hover:bg-gray-100 text-center py-3 text-gray-700 font-medium border-t border-gray-200">
            View Careers <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Messages Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">New Messages</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">5</h3>
                </div>
                <div class="bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-envelope text-red-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 25%
                </span>
                <span class="text-gray-500 ml-2">from last week</span>
            </div>
        </div>
        <a href="{{ route('admin.contact.index') }}" class="block bg-gray-50 hover:bg-gray-100 text-center py-3 text-red-600 font-medium border-t border-gray-200">
            View Messages <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</div>

<!-- Three Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Visitor Statistics Chart -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Visitor Analytics</h2>
                    <p class="text-gray-600 text-sm">Last 7 days website traffic</p>
                </div>
                <div class="flex space-x-2">
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                    </select>
                </div>
            </div>
            
            <!-- Simple Bar Chart (CSS Based) -->
            <div class="mt-6">
                <div class="flex items-end justify-between h-48 space-x-1">
                    <!-- Monday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 70%"></div>
                        <span class="text-xs text-gray-500 mt-2">Mon</span>
                        <span class="text-xs font-medium">245</span>
                    </div>
                    <!-- Tuesday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 85%"></div>
                        <span class="text-xs text-gray-500 mt-2">Tue</span>
                        <span class="text-xs font-medium">312</span>
                    </div>
                    <!-- Wednesday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 92%"></div>
                        <span class="text-xs text-gray-500 mt-2">Wed</span>
                        <span class="text-xs font-medium">398</span>
                    </div>
                    <!-- Thursday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 65%"></div>
                        <span class="text-xs text-gray-500 mt-2">Thu</span>
                        <span class="text-xs font-medium">287</span>
                    </div>
                    <!-- Friday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 78%"></div>
                        <span class="text-xs text-gray-500 mt-2">Fri</span>
                        <span class="text-xs font-medium">345</span>
                    </div>
                    <!-- Saturday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 55%"></div>
                        <span class="text-xs text-gray-500 mt-2">Sat</span>
                        <span class="text-xs font-medium">210</span>
                    </div>
                    <!-- Sunday -->
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-500 rounded-t-lg" style="height: 48%"></div>
                        <span class="text-xs text-gray-500 mt-2">Sun</span>
                        <span class="text-xs font-medium">187</span>
                    </div>
                </div>
            </div>
            
            <!-- Visitor Stats Summary -->
            <div class="grid grid-cols-3 gap-4 mt-8 pt-6 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-sm text-gray-600">Avg. Daily Visitors</p>
                    <p class="text-xl font-bold text-gray-800">312</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600">Bounce Rate</p>
                    <p class="text-xl font-bold text-green-600">32%</p>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-600">Avg. Session</p>
                    <p class="text-xl font-bold text-blue-600">4m 22s</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Traffic Sources -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Traffic Sources</h2>
        <div class="space-y-4">
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 text-sm">Direct</span>
                    <span class="font-medium text-gray-800">42%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 42%"></div>
                </div>
            </div>
            
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 text-sm">Social Media</span>
                    <span class="font-medium text-gray-800">28%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 28%"></div>
                </div>
            </div>
            
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 text-sm">Search Engines</span>
                    <span class="font-medium text-gray-800">18%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 18%"></div>
                </div>
            </div>
            
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700 text-sm">Referrals</span>
                    <span class="font-medium text-gray-800">12%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-600 h-2 rounded-full" style="width: 12%"></div>
                </div>
            </div>
        </div>
        
        <!-- Top Pages -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="font-medium text-gray-800 mb-3">Top Pages</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 truncate">Homepage</span>
                    <span class="text-sm font-medium">1,842 visits</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 truncate">News Section</span>
                    <span class="text-sm font-medium">987 visits</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 truncate">Career Page</span>
                    <span class="text-sm font-medium">654 visits</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700 truncate">CSR Programs</span>
                    <span class="text-sm font-medium">432 visits</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Two Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activity -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                    <p class="text-gray-600 text-sm">Latest updates from all sections</p>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    View All <i class="fas fa-external-link-alt ml-2"></i>
                </a>
            </div>

            <div class="space-y-4">
                <!-- Visitor Activity -->
                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-indigo-100">
                            <i class="fas fa-user-plus text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Peak visitor traffic</p>
                        <p class="text-gray-600 text-sm">398 visitors on Wednesday - highest this week</p>
                        <p class="text-gray-400 text-xs mt-1">2 days ago</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                        +24%
                    </span>
                </div>

                <!-- News Activity -->
                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-blue-100">
                            <i class="fas fa-newspaper text-blue-600"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">New article published</p>
                        <p class="text-gray-600 text-sm">"Annual Financial Report 2024" received 156 views</p>
                        <p class="text-gray-400 text-xs mt-1">Yesterday, 3:45 PM</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                        156 views
                    </span>
                </div>

                <!-- Career Activity -->
                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-purple-100">
                            <i class="fas fa-briefcase text-purple-600"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Career page traffic surge</p>
                        <p class="text-gray-600 text-sm">Senior Developer position viewed 89 times today</p>
                        <p class="text-gray-400 text-xs mt-1">Today, 11:30 AM</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                        89 views
                    </span>
                </div>

                <!-- Messages Activity -->
                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition duration-200">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-red-100">
                            <i class="fas fa-envelope text-red-600"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Contact form submissions</p>
                        <p class="text-gray-600 text-sm">3 new messages from website contact form</p>
                        <p class="text-gray-400 text-xs mt-1">Today, 9:15 AM</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                        3 new
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Stats -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.news.create') }}"
                    class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 p-4 rounded-lg text-center transition duration-200 group">
                    <i class="fas fa-plus-circle text-lg mb-2 block"></i>
                    <span class="font-medium text-sm">Add News</span>
                </a>
                <a href="{{ route('admin.csr.create') }}"
                    class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 p-4 rounded-lg text-center transition duration-200 group">
                    <i class="fas fa-plus-circle text-lg mb-2 block"></i>
                    <span class="font-medium text-sm">Add CSR</span>
                </a>
                <a href="{{ route('admin.career.create') }}"
                    class="bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 p-4 rounded-lg text-center transition duration-200 group">
                    <i class="fas fa-plus-circle text-lg mb-2 block"></i>
                    <span class="font-medium text-sm">Add Job</span>
                </a>
                <a href="#"
                    class="bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 text-indigo-700 p-4 rounded-lg text-center transition duration-200 group">
                    <i class="fas fa-chart-line text-lg mb-2 block"></i>
                    <span class="font-medium text-sm">Analytics</span>
                </a>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">System Status</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 text-sm">Storage Usage</span>
                        <span class="font-medium text-gray-800">78%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 text-sm">Database</span>
                        <span class="font-medium text-gray-800">42%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 42%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 text-sm">Memory Usage</span>
                        <span class="font-medium text-gray-800">65%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Real-time Visitors -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-700 text-sm font-medium">Active Visitors</p>
                        <p class="text-2xl font-bold text-gray-800">24</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-lg">
                        <i class="fas fa-eye text-indigo-600"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Users currently browsing the site</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }
    
    /* Animation for bar chart */
    @keyframes barGrow {
        from { height: 0; }
        to { height: var(--target-height); }
    }
    
    .bar-animate {
        animation: barGrow 1s ease-out forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple animation for bar chart
        const bars = document.querySelectorAll('[style*="height:"]');
        bars.forEach((bar, index) => {
            setTimeout(() => {
                bar.classList.add('bar-animate');
            }, index * 100);
        });
        
        // Update active visitors count every 30 seconds (simulated)
        function updateActiveVisitors() {
            const activeVisitorsEl = document.querySelector('.text-2xl.font-bold.text-gray-800');
            if (activeVisitorsEl) {
                const current = parseInt(activeVisitorsEl.textContent);
                const change = Math.random() > 0.5 ? 1 : -1;
                const newCount = Math.max(10, Math.min(50, current + change));
                activeVisitorsEl.textContent = newCount;
            }
        }
        
        setInterval(updateActiveVisitors, 30000);
    });
</script>
@endpush