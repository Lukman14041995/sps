<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-cog text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold">Admin<span class="text-blue-400">Panel</span></h1>
                    <p class="text-xs text-gray-400 mt-1">Management System</p>
                </div>
            </div>
            <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-120px)]">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('admin.dashboard') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="fas fa-tachometer-alt w-5 text-center {{ Request::routeIs('admin.dashboard') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>Dashboard</span>
        </a>

        <p class="px-3 text-xs text-gray-400 uppercase tracking-wider mb-2">Konten</p>
        <!-- News -->
        <a href="{{ route('admin.news.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('news.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="far fa-newspaper w-5 text-center {{ Request::routeIs('news.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>News</span>
            <span class="ml-auto bg-blue-500 text-xs px-2 py-1 rounded-full">42</span>
        </a>

        <!-- CSR -->
        <a href="{{ route('admin.csr.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('csr.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="fas fa-hands-helping w-5 text-center {{ Request::routeIs('csr.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>CSR</span>
            <span class="ml-auto bg-green-500 text-xs px-2 py-1 rounded-full">18</span>
        </a>

        <!-- Career -->
        <a href="{{ route('admin.career.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('career.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="fas fa-briefcase w-5 text-center {{ Request::routeIs('career.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>Career</span>
            <span class="ml-auto bg-purple-500 text-xs px-2 py-1 rounded-full">7</span>
        </a>

        <!-- Contact Messages -->
        <a href="{{ route('admin.contact.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('contact.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="far fa-envelope w-5 text-center {{ Request::routeIs('contact.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>Messages</span>
            <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">5</span>
        </a>

        <a href="{{ route('admin.contact.index') }}"
            class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 {{ Request::routeIs('contact.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
            <i
                class="far fa-building w-5 text-center {{ Request::routeIs('contact.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
            <span>Bussines Units</span>
            <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">5</span>
        </a>

        @if (auth()->check() && auth()->user()->hasRole('master'))
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200
   {{ Request::routeIs('admin.users.*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
                <i
                    class="fas fa-users w-5 text-center
    {{ Request::routeIs('admin.users.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
                <span>User Management</span>
            </a>
        @endif
        



        <!-- Settings (Optional) -->
        <div class="pt-6 mt-6 border-t border-gray-700">
            <p class="px-3 text-xs text-gray-400 uppercase tracking-wider mb-2">Settings</p>
            <a href="{{ route('admin.news-categories.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i
                    class="fas fa-list w-5 text-center {{ Request::routeIs('news-categories.*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
                <span>News Categories</span>
                <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">5</span>
            </a>
            <a href="#"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-rectangle-list w-5 text-center text-gray-400"></i>
                <span>Menu</span>
            </a>
            </a>
            <a href="#"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-users w-5 text-center text-gray-400"></i>
                <span>User Settings</span>
            </a>
            <a href="#"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 hover:bg-gray-700">
                <i class="fas fa-cog w-5 text-center text-gray-400"></i>
                <span>System Settings</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700 bg-gray-800">
        <div class="flex items-center space-x-3">
            <div
                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1">
                <p class="font-medium text-sm">{{ Auth::user()->name ?? 'Admin User' }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

<!-- JavaScript for sidebar toggle -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeSidebarButton = document.getElementById('close-sidebar');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            mobileMenuButton.addEventListener('click', openSidebar);
            closeSidebarButton.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar on window resize if it becomes desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });
        });
    </script>
@endpush
