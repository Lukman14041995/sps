import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        // 🔥 WAJIB UNTUK STATAMIC
        './resources/**/*.antlers.html',
        './content/**/*.md',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // =============================
            // Animations & Keyframes
            // =============================
            keyframes: { // ❗ typo kamu: kkeyframes
                fadeInOnScroll: {
                    '0%': { opacity: 0, transform: 'translateY(24px)' },
                    '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                pulseSlow: {
                    '0%, 100%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.05)' },
                },
            },
            animation: {
                'fadeIn-on-scroll': 'fadeInOnScroll 1s ease-out forwards',
                'pulse-slow': 'pulseSlow 6s ease-in-out infinite',
            },
        },
    },

    plugins: [forms],
};
