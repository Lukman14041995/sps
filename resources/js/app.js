import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// --- Kode custom kamu mulai di bawah ---
document.addEventListener('DOMContentLoaded', () => {
    const fadeElements = document.querySelectorAll('.animate-fadeIn-on-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeIn-on-scroll');
                entry.target.classList.remove('opacity-0', 'translate-y-6');
            }
        });
    }, { threshold: 0.2 });

    fadeElements.forEach(el => observer.observe(el));
});