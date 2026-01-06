<header class="sticky top-0 z-40 bg-white border-b border-gray-200 py-4 px-6 shadow-sm">
    <div class="flex justify-between items-center">
        <!-- Mobile Menu Button (Hidden on desktop) -->
        <button id="mobile-menu-button" class="lg:hidden text-gray-600 hover:text-gray-800">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Breadcrumb (Optional) -->
        <div class="hidden md:flex items-center space-x-2 text-sm">
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-home"></i>
            </a>
            <span class="text-gray-400">/</span>
            <!-- @yield('breadcrumb', '<span class="text-gray-800">' . ($title ?? 'Dashboard') . '</span>') -->
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative">
                <button id="notification-button" class="text-gray-600 hover:text-gray-800 relative">
                    <i class="far fa-bell text-xl"></i>
                    @if($unreadNotifications ?? 0 > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ min($unreadNotifications ?? 0, 9) }}{{ ($unreadNotifications ?? 0) > 9 ? '+' : '' }}
                    </span>
                    @endif
                </button>
                <!-- Notification Dropdown (Can be added with JS) -->
            </div>

            <!-- User Profile -->
            <div class="relative" 
                 x-data="{ open: false }"
                 @mouseenter="open = true"
                 @mouseleave="open = false"
                 x-on:click.outside="open = false">
                
                <button class="flex items-center space-x-3 focus:outline-none" @click="open = !open">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="hidden md:inline text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-200" 
                       :class="{ 'rotate-180': open }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 border border-gray-100"
                     @mouseenter="open = true"
                     @mouseleave="open = false">
                    
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                        <i class="fas fa-user mr-3 text-gray-400"></i>Profile
                    </a>
                    
                    <a href="{{ route('password.change.form') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                        <i class="fas fa-cog mr-3 text-gray-400"></i>Change Password
                    </a>
                    
                    <div class="border-t border-gray-200 my-2"></div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 transition-colors duration-150">
                            <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>