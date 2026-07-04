import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'ssb-black': '#1A1A1A',
                'ssb-white': '#FFFFFF',
                orange: {
                    50: 'var(--theme-50, #fff7ed)',
                    100: 'var(--theme-100, #ffedd5)',
                    200: 'var(--theme-200, #fed7aa)',
                    300: 'var(--theme-300, #fdba74)',
                    400: 'var(--theme-400, #fb923c)',
                    500: 'var(--theme-500, #f97316)',
                    600: 'var(--theme-600, #ea580c)',
                    700: 'var(--theme-700, #c2410c)',
                    800: 'var(--theme-800, #9a3412)',
                    900: 'var(--theme-900, #7c2d12)',
                    950: 'var(--theme-950, #431407)',
                },
                'ssb-orange': 'var(--theme-500, #f97316)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};