<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64
           bg-gradient-to-b from-[#0b1c33] via-[#0b1c33] to-[#081628]
           text-white transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out
           flex flex-col shadow-2xl">

    <!-- ================= HEADER ================= -->
    <div
        class="px-5 py-4 border-b border-blue-900/40 flex items-center justify-between
               bg-[#0b1c33]/80 backdrop-blur">

        <div class="flex items-center space-x-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600
                       rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-layer-group text-white"></i>
            </div>
            <div>
                <h1 class="text-base font-semibold leading-tight tracking-wide">
                    SPS <span class="text-blue-400">Admin</span>
                </h1>
                <p class="text-[11px] text-blue-200/60">Corporate System</p>
            </div>
        </div>

        <button id="close-sidebar" class="lg:hidden text-blue-200 hover:text-white transition">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    <!-- ================= MENU ================= -->
    <nav
        class="flex-1 overflow-y-auto px-3 py-4 space-y-1
               scrollbar-thin scrollbar-thumb-blue-900/60 scrollbar-track-transparent">

        @php
            // MENU KONTEN (berdasarkan TITLE)
            $contentMenus = ['News', 'CSR', 'Career', 'Message', 'Messages', 'Contact'];
        @endphp

        <!-- ===== LABEL KONTEN ===== -->
        <p class="px-3 mt-2 mb-2 text-[11px] uppercase tracking-widest text-blue-300/60">
            Konten
        </p>

        @foreach ($menus as $menu)
            @if (in_array($menu->title, $contentMenus))
                @php
                    $isActive = $menu->route ? Request::routeIs($menu->route . '*') : false;
                @endphp

                <!-- MAIN MENU -->
                <a href="{{ $menu->route ? route($menu->route) : '#' }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isActive
                        ? 'bg-blue-600/25 text-blue-200 shadow-inner'
                        : 'text-blue-100/80 hover:bg-blue-900/40 hover:text-white' }}">

                    <i
                        class="{{ $menu->icon }} w-5 text-center
                        {{ $isActive ? 'text-blue-400' : 'text-blue-300/70 group-hover:text-white' }}"></i>

                    <span class="flex-1 truncate">{{ $menu->title }}</span>
                </a>

                <!-- CHILD MENU -->
                @foreach ($menu->children as $child)
                    @php
                        $isChildActive = $child->route ? Request::routeIs($child->route . '*') : false;
                    @endphp

                    <a href="{{ $child->route ? route($child->route) : '#' }}"
                        class="flex items-center gap-3 ml-6 pl-3 pr-3 py-2 rounded-md text-sm transition-all border-l-2
                        {{ $isChildActive
                            ? 'border-blue-400 bg-blue-600/15 text-blue-200'
                            : 'border-blue-900 text-blue-200/60 hover:bg-blue-900/40 hover:text-white hover:border-blue-500' }}">

                        <i class="{{ $child->icon }} w-4 text-center text-xs"></i>
                        <span class="truncate">{{ $child->title }}</span>
                    </a>
                @endforeach
            @endif
        @endforeach


        <!-- ===== LABEL SETTING ===== -->
        <p class="px-3 mt-6 mb-2 text-[11px] uppercase tracking-widest text-blue-300/60">
            Setting
        </p>

        @foreach ($menus as $menu)
            @if (!in_array($menu->title, $contentMenus))
                @php
                    $isActive = $menu->route ? Request::routeIs($menu->route . '*') : false;
                @endphp

                <!-- MAIN MENU -->
                <a href="{{ $menu->route ? route($menu->route) : '#' }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
                    {{ $isActive
                        ? 'bg-blue-600/25 text-blue-200 shadow-inner'
                        : 'text-blue-100/80 hover:bg-blue-900/40 hover:text-white' }}">

                    <i
                        class="{{ $menu->icon }} w-5 text-center
                        {{ $isActive ? 'text-blue-400' : 'text-blue-300/70 group-hover:text-white' }}"></i>

                    <span class="flex-1 truncate">{{ $menu->title }}</span>
                </a>

                <!-- CHILD MENU -->
                @foreach ($menu->children as $child)
                    @php
                        $isChildActive = $child->route ? Request::routeIs($child->route . '*') : false;
                    @endphp

                    <a href="{{ $child->route ? route($child->route) : '#' }}"
                        class="flex items-center gap-3 ml-6 pl-3 pr-3 py-2 rounded-md text-sm transition-all border-l-2
                        {{ $isChildActive
                            ? 'border-blue-400 bg-blue-600/15 text-blue-200'
                            : 'border-blue-900 text-blue-200/60 hover:bg-blue-900/40 hover:text-white hover:border-blue-500' }}">

                        <i class="{{ $child->icon }} w-4 text-center text-xs"></i>
                        <span class="truncate">{{ $child->title }}</span>
                    </a>
                @endforeach
            @endif
        @endforeach

    </nav>

    <!-- ================= FOOTER ================= -->
    <div class="px-4 py-4 border-t border-blue-900/40 bg-[#081628]/90 backdrop-blur">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600
                       rounded-full flex items-center justify-center
                       text-white font-semibold shadow-md">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate">
                    {{ Auth::user()->name ?? 'Admin User' }}
                </p>
                <p class="text-xs text-blue-200/60 truncate">
                    {{ Auth::user()->email ?? 'admin@sps.co.id' }}
                </p>
            </div>
        </div>
    </div>
</aside>

<!-- ================= OVERLAY MOBILE ================= -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 lg:hidden hidden backdrop-blur-sm transition-opacity">
</div>

<!-- ================= SCRIPT ================= -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileBtn = document.getElementById('mobile-menu-button');
            const closeBtn = document.getElementById('close-sidebar');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            if (mobileBtn) mobileBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    overlay.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                }
            });
        });
    </script>
@endpush
