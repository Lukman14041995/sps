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
    <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-120px)] bg-gray-900">
        @foreach ($menus as $menu)
            <a href="{{ $menu->route ? route($menu->route) : '#' }}"
                class="flex items-center space-x-3 p-3 rounded-lg transition duration-200
           {{ Request::routeIs($menu->route . '*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
                <i
                    class="{{ $menu->icon }} w-5 text-center
                {{ Request::routeIs($menu->route . '*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
                <span>{{ $menu->title }}</span>

                @if ($menu->count)
                    <span class="ml-auto bg-blue-500 text-xs px-2 py-1 rounded-full">{{ $menu->count }}</span>
                @endif
            </a>

            {{-- Loop children --}}
            @foreach ($menu->children as $child)
                <a href="{{ $child->route ? route($child->route) : '#' }}"
                    class="flex items-center space-x-3 p-3 rounded-lg ml-4 transition duration-200
               {{ Request::routeIs($child->route . '*') ? 'bg-gray-700 text-blue-300' : 'hover:bg-gray-700' }}">
                    <i
                        class="{{ $child->icon }} w-5 text-center
                    {{ Request::routeIs($child->route . '*') ? 'text-blue-400' : 'text-gray-400' }}"></i>
                    <span>{{ $child->title }}</span>
                </a>
            @endforeach
        @endforeach
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
