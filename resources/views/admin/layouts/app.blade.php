<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Toast Notification Styles -->
    <style>
        /* Toast Animations */
        @keyframes toastSlideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes toastSlideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .toast-slide-in {
            animation: toastSlideIn 0.3s ease-out forwards;
        }

        .toast-slide-out {
            animation: toastSlideOut 0.3s ease-out forwards;
        }

        .toast-progress {
            animation: toastProgress var(--toast-duration) linear forwards;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-6 right-6 z-[9999] space-y-4 w-96 max-w-full pointer-events-none"></div>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Header -->
        @include('admin.layouts.header')

        <!-- Main Content Area -->
        <main class="p-6">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                @hasSection('subtitle')
                    <p class="text-gray-600 mt-1">@yield('subtitle')</p>
                @endif
            </div>

            <!-- Content -->
            @yield('content')
        </main>

        <!-- Footer -->
        @includeWhen(View::exists('admin.layouts.footer'), 'admin.layouts.footer')
    </div>

    <!-- Global Toast Notification Script -->
    <script>
        // Toast Notification System
        class ToastNotification {
            constructor() {
                this.container = document.getElementById('toast-container');
                if (!this.container) {
                    this.createContainer();
                }
                this.toasts = new Map();
                this.maxToasts = 3;
            }

            createContainer() {
                this.container = document.createElement('div');
                this.container.id = 'toast-container';
                this.container.className = 'fixed top-6 right-6 z-[9999] space-y-4 w-96 max-w-full pointer-events-none';
                document.body.appendChild(this.container);
            }

            show(message, type = 'success', duration = 5000) {
                // Remove oldest toast if at max capacity
                if (this.toasts.size >= this.maxToasts) {
                    const oldestKey = Array.from(this.toasts.keys())[0];
                    this.remove(oldestKey);
                }

                const toastId = 'toast-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                const toast = this.createToastElement(message, type, toastId, duration);

                this.container.appendChild(toast);
                this.toasts.set(toastId, {
                    element: toast,
                    timeout: null
                });

                // Auto remove after duration
                const timeoutId = setTimeout(() => {
                    this.remove(toastId);
                }, duration);

                this.toasts.get(toastId).timeout = timeoutId;

                return toastId;
            }

            createToastElement(message, type, toastId, duration) {
                const toast = document.createElement('div');
                toast.id = toastId;
                toast.className = `pointer-events-auto transform transition-all duration-300 toast-slide-in`;
                toast.style.setProperty('--toast-duration', duration + 'ms');

                const colors = {
                    success: {
                        bg: 'from-green-500 to-emerald-600',
                        icon: 'fa-check-circle',
                        iconBg: 'bg-green-400',
                        iconColor: 'text-green-100',
                        text: 'text-green-50',
                        textLight: 'text-green-100',
                        progress: 'bg-green-200'
                    },
                    error: {
                        bg: 'from-red-500 to-rose-600',
                        icon: 'fa-exclamation-circle',
                        iconBg: 'bg-red-400',
                        iconColor: 'text-red-100',
                        text: 'text-red-50',
                        textLight: 'text-red-100',
                        progress: 'bg-red-200'
                    },
                    warning: {
                        bg: 'from-yellow-500 to-amber-600',
                        icon: 'fa-exclamation-triangle',
                        iconBg: 'bg-yellow-400',
                        iconColor: 'text-yellow-100',
                        text: 'text-yellow-50',
                        textLight: 'text-yellow-100',
                        progress: 'bg-yellow-200'
                    },
                    info: {
                        bg: 'from-blue-500 to-cyan-600',
                        icon: 'fa-info-circle',
                        iconBg: 'bg-blue-400',
                        iconColor: 'text-blue-100',
                        text: 'text-blue-50',
                        textLight: 'text-blue-100',
                        progress: 'bg-blue-200'
                    }
                };

                const color = colors[type] || colors.success;

                toast.innerHTML = `
                    <div class="p-4 rounded-xl shadow-2xl bg-gradient-to-r ${color.bg}">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full ${color.iconBg} bg-opacity-20 flex items-center justify-center">
                                    <i class="fas ${color.icon} text-xl ${color.iconColor}"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold ${color.text}">
                                    ${type.charAt(0).toUpperCase() + type.slice(1)}
                                </p>
                                <p class="mt-1 text-sm ${color.textLight}">
                                    ${message}
                                </p>
                            </div>
                            <button onclick="window.toastNotification.remove('${toastId}')" 
                                    class="flex-shrink-0 ml-4 ${color.textLight} hover:text-white transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="mt-3 w-full ${color.iconBg} bg-opacity-30 rounded-full h-1">
                            <div class="${color.progress} h-1 rounded-full toast-progress"></div>
                        </div>
                    </div>
                `;

                return toast;
            }

            remove(toastId) {
                if (!this.toasts.has(toastId)) return;

                const toastData = this.toasts.get(toastId);

                // Clear timeout
                if (toastData.timeout) {
                    clearTimeout(toastData.timeout);
                }

                // Add exit animation
                toastData.element.classList.remove('toast-slide-in');
                toastData.element.classList.add('toast-slide-out');

                // Remove after animation
                setTimeout(() => {
                    if (toastData.element.parentNode) {
                        toastData.element.remove();
                    }
                    this.toasts.delete(toastId);
                }, 300);
            }

            removeAll() {
                Array.from(this.toasts.keys()).forEach(key => {
                    this.remove(key);
                });
            }
        }

        // Initialize global toast notification
        window.toastNotification = new ToastNotification();

        // Helper function for quick access
        window.showToast = function(message, type = 'success', duration = 5000) {
            return window.toastNotification.show(message, type, duration);
        };
    </script>

    @stack('scripts')
</body>

</html>
