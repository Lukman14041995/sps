<section class="relative w-full h-screen -mt-20 overflow-hidden bg-black">

    <!-- SLIDER -->
    <div id="hero-slider" class="relative w-full h-full">

        <!-- SLIDE -->
        <div class="hero-slide active">
            <img src="{{ asset('img/home/1.jpeg') }}" class="hero-image w-full h-full object-cover scale-110"
                alt="Welcome to SPS Corporate">
            <div class="overlay"></div>

            <div class="hero-overlay">
                <div class="content">
                    <span class="badge">SINCE 1973</span>
                    <h1>Welcome to <span class="text-blue-300">SPS Corporate</span></h1>
                    <p>Eco-friendly paper solutions for modern industries</p>
                    <a href="/about" class="btn btn-blue">Learn More</a>
                </div>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('img/home/2.jpg') }}" class="hero-image w-full h-full object-cover scale-110"
                alt="Responsible Manufacturing">
            <div class="overlay"></div>

            <div class="hero-overlay">
                <div class="content">
                    <span class="badge">QUALITY ASSURANCE</span>
                    <h1>Responsible <span class="text-green-300">Manufacturing</span></h1>
                    <p>High quality paper with low environmental impact</p>
                    <a href="/products" class="btn btn-green">Our Products</a>
                </div>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('img/home/3.jpg') }}" class="hero-image w-full h-full object-cover scale-110"
                alt="Custom Paper Solutions">
            <div class="overlay"></div>

            <div class="hero-overlay">
                <div class="content">
                    <span class="badge">CUSTOM SOLUTIONS</span>
                    <h1>Custom Paper <span class="text-amber-300">Solutions</span></h1>
                    <p>Tailored products for your business needs</p>
                    <a href="/contact" class="btn btn-amber">Get Quote</a>
                </div>
            </div>
        </div>

        <!-- CONTROLS -->
        <button id="prevSlide" class="nav-btn left">‹</button>
        <button id="nextSlide" class="nav-btn right">›</button>

        <!-- DOTS -->
        <div id="heroDots" class="dots"></div>

        <!-- PROGRESS -->
        <div class="progress">
            <div id="progressBar"></div>
        </div>
    </div>
</section>

<style>
    .hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity .8s ease;
    }

    .hero-slide.active {
        opacity: 1;
    }

    .hero-image {
        animation: zoom 20s linear forwards;
    }

    @keyframes zoom {
        from {
            transform: scale(1.1);
        }

        to {
            transform: scale(1.15);
        }
    }

    .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, .85), rgba(0, 0, 0, .4), transparent);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        z-index: 2;
        padding: 2rem;
    }

    .content {
        max-width: 720px;
        color: white;
    }

    .content h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        margin: 1rem 0;
    }

    .content p {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        color: #e5e7eb;
        margin-bottom: 2rem;
    }

    .badge {
        display: inline-block;
        padding: .5rem 1rem;
        background: rgba(255, 255, 255, .2);
        backdrop-filter: blur(6px);
        border-radius: 999px;
        font-size: .75rem;
        letter-spacing: .15em;
    }

    .btn {
        display: inline-block;
        padding: .75rem 1.5rem;
        border-radius: .5rem;
        font-weight: 600;
        color: white;
    }

    .btn-blue {
        background: #2563eb;
    }

    .btn-green {
        background: #16a34a;
    }

    .btn-amber {
        background: #d97706;
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(0, 0, 0, .5);
        color: white;
        font-size: 1.5rem;
        z-index: 5;
    }

    .nav-btn.left {
        left: 1rem;
    }

    .nav-btn.right {
        right: 1rem;
    }

    .dots {
        position: absolute;
        bottom: 1.5rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: .5rem;
        z-index: 5;
    }

    .dots button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .4);
    }

    .dots button.active {
        background: white;
    }

    .progress {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: rgba(255, 255, 255, .2);
    }

    .progress div {
        height: 100%;
        width: 0;
        background: #3b82f6;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const slides = document.querySelectorAll('.hero-slide');
        const dotsWrap = document.getElementById('heroDots');
        const prev = document.getElementById('prevSlide');
        const next = document.getElementById('nextSlide');
        const progress = document.getElementById('progressBar');

        let index = 0;
        const interval = 5000;
        let timer;

        // BUILD DOTS AUTOMATIC
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(dot);
        });

        const dots = dotsWrap.querySelectorAll('button');

        function goTo(i) {
            slides.forEach((s, idx) => s.classList.toggle('active', idx === i));
            dots.forEach((d, idx) => d.classList.toggle('active', idx === i));
            index = i;
            restart();
        }

        function nextSlide() {
            goTo((index + 1) % slides.length);
        }

        function prevSlide() {
            goTo((index - 1 + slides.length) % slides.length);
        }

        function startProgress() {
            progress.style.transition = 'none';
            progress.style.width = '0';
            setTimeout(() => {
                progress.style.transition = `width ${interval}ms linear`;
                progress.style.width = '100%';
            }, 20);
        }

        function restart() {
            clearInterval(timer);
            startProgress();
            timer = setInterval(nextSlide, interval);
        }

        prev.addEventListener('click', prevSlide);
        next.addEventListener('click', nextSlide);

        goTo(0);
    });
</script>
