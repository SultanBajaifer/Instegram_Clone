const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: {
                    '100': '#f7fafc',
                    '200': '#edf2f7',
                    '300': '#e2e8f0',
                    '400': '#cbd5e0',
                    '500': '#a0aec0',
                    '600': '#718096',
                    '700': '#4a5568',
                    '800': '#2d3748',
                    '900': '#1a202c',
                },
                red: {
                    '100': '#fff5f5',
                    '200': '#fed7d7',
                    '300': '#feb2b2',
                    '400': '#fc8181',
                    '500': '#f56565',
                    '600': '#e53e3e',
                    '700': '#c53030',
                    '800': '#9b2c2c',
                    '900': '#742a2a',
                },
                blue: {
                    '100': '#ebf8ff',
                    '200': '#bee3f8',
                    '300': '#90cdf4',
                    '400': '#63b3ed',
                    '500': '#4299e1',
                    '600': '#3182ce',
                    '700': '#2b6cb0',
                    '800': '#2c5282',
                    '900': '#2a4365',
                },
            },
            spacing: {
                '0': '0',
                '1': '0.25rem',
                '2': '0.5rem',
                '3': '0.75rem',
                '4': '1rem',
                '5': '1.25rem',
                '6': '1.5rem',
                '8': '2rem',
                '10': '2.5rem',
                '12': '3rem',
                '16': '4rem',
                '20': '5rem',
                '24': '6rem',
                '32': '8rem',
                '40': '10rem',
                '48': '12rem',
                '56': '14rem',
                '64': '16rem',
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwindcss-rtl')
    ],
};
