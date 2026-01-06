<section class="relative w-full h-[90vh] overflow-hidden bg-gradient-to-br from-gray-900 to-gray-950">

    <!-- SLIDES -->
    <div id="hero-slider" class="relative w-full h-full">
        <!-- Slide 1 -->
        <div class="hero-slide active">
            <div class="absolute inset-0">
                <img src="{{ asset('img/home/1.jpeg') }}"
                    class="hero-image w-full h-full object-cover scale-110"
                    alt="Welcome to SPS Corporate"
                    onerror="this.src='https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
            </div>
            <div class="hero-overlay">
                <div class="max-w-4xl px-6">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                        <span class="text-white text-sm font-medium tracking-wider">SINCE 1973</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Welcome To <span class="text-blue-300">SPS Corporate</span>
                    </h1>
                    <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                        Eco-friendly products for modern industries
                    </p>
                    <a href="/about"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
                        <span>Learn More</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <div class="absolute inset-0">
                <img src="{{ asset('img/home/2.jpg') }}"
                    class="hero-image w-full h-full object-cover scale-110"
                    alt="Responsible Manufacturing"
                    onerror="this.src='https://images.unsplash.com/photo-1556761175-4b46a572b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
            </div>
            <div class="hero-overlay">
                <div class="max-w-4xl px-6">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                        <span class="text-white text-sm font-medium tracking-wider">QUALITY ASSURANCE</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Responsible <span class="text-green-300">Manufacturing</span>
                    </h1>
                    <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                        High quality paper with low environmental impact
                    </p>
                    <a href="/products"
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300">
                        <span>Our Products</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <div class="absolute inset-0">
                <img src="{{ asset('img/home/3.jpg') }}"
                    class="hero-image w-full h-full object-cover scale-110"
                    alt="Custom Paper Solutions"
                    onerror="this.src='https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
            </div>
            <div class="hero-overlay">
                <div class="max-w-4xl px-6">
                    <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                        <span class="text-white text-sm font-medium tracking-wider">CUSTOM SOLUTIONS</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Custom Paper <span class="text-amber-300">Solutions</span>
                    </h1>
                    <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                        Tailored products for your business needs
                    </p>
                    <a href="/contact"
                        class="inline-flex items-center px-6 py-3 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700 transition-all duration-300">
                        <span>Get Quote</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- BUTTONS -->
    <button id="prevSlide"
        class="hero-btn absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 text-white rounded-full hover:bg-black/70 transition-colors duration-300 flex items-center justify-center z-20">
        ‹
    </button>

    <button id="nextSlide"
        class="hero-btn absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 text-white rounded-full hover:bg-black/70 transition-colors duration-300 flex items-center justify-center z-20">
        ›
    </button>

    <!-- INDICATOR DOTS -->
    <div id="hero-dots" class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
        <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 active" data-slide="0"></button>
        <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="1"></button>
        <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="2"></button>
    </div>

    <!-- PROGRESS BAR -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gray-800/50 z-10">
        <div id="progressBar" class="h-full bg-gradient-to-r from-blue-500 to-blue-600 w-0 transition-all duration-5000"></div>
    </div>

    <!-- SCROLL HINT -->
    <div class="absolute bottom-6 right-6 hidden lg:block animate-bounce">
        <div class="flex flex-col items-center text-white/60">
            <span class="text-xs mb-1">Scroll</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.hero-dot');
            const prevBtn = document.getElementById('prevSlide');
            const nextBtn = document.getElementById('nextSlide');
            const progressBar = document.getElementById('progressBar');
            let currentIndex = 0;
            const intervalTime = 5000;
            let slideInterval;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                    dots[i].classList.toggle('active', i === index);
                });
                currentIndex = index;
                resetProgressBar();
            }

            function nextSlideFunc() {
                let nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }

            function prevSlideFunc() {
                let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(prevIndex);
            }

            function startProgressBar() {
                progressBar.style.width = '100%';
                progressBar.style.transition = `width ${intervalTime}ms linear`;
            }

            function resetProgressBar() {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0';
                setTimeout(() => {
                    startProgressBar();
                }, 10);
            }

            function startInterval() {
                slideInterval = setInterval(nextSlideFunc, intervalTime);
                startProgressBar();
            }

            function resetInterval() {
                clearInterval(slideInterval);
                startInterval();
            }

            // Event Listeners
            nextBtn.addEventListener('click', () => {
                nextSlideFunc();
                resetInterval();
            });

            prevBtn.addEventListener('click', () => {
                prevSlideFunc();
                resetInterval();
            });

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    showSlide(parseInt(dot.dataset.slide));
                    resetInterval();
                });
            });

            // Pause on hover
            const slider = document.getElementById('hero-slider');
            slider.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
                progressBar.style.transition = 'none';
            });

            slider.addEventListener('mouseleave', () => {
                resetInterval();
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlideFunc();
                if (e.key === 'ArrowRight') nextSlideFunc();
            });

            // Initialize
            showSlide(currentIndex);
            startInterval();
        });
    </script>
</section>

<style>
    /* Hero Slide Styles */
    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
    }

    .hero-slide.active {
        opacity: 1;
    }

    .hero-slide.active .hero-image {
        animation: zoomIn 20s ease-out forwards;
    }

    @keyframes zoomIn {
        from {
            transform: scale(1.1);
        }

        to {
            transform: scale(1.15);
        }
    }

    /* Overlay */
    .hero-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
        z-index: 10;
    }

    /* Dot Indicator */
    .hero-dot.active {
        background: white;
        transform: scale(1.2);
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
    }

    /* Bounce animation */
    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .animate-bounce {
        animation: bounce 2s ease-in-out infinite;
    }

    /* Smooth transitions */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>