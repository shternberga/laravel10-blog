import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    mode: 'jit', 
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/pages/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
            },
            fontSize: {
              xs: ['0.75rem', { lineHeight: '1.5' }],
              sm: ['0.875rem', { lineHeight: '1.5715' }],
              base: ['1rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
              lg: ['1.125rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
              xl: ['1.25rem', { lineHeight: '1.5', letterSpacing: '-0.01em' }],
              '2xl': ['1.5rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
              '3xl': ['1.88rem', { lineHeight: '1.33', letterSpacing: '-0.01em' }],
              '4xl': ['2.25rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
              '5xl': ['3rem', { lineHeight: '1.25', letterSpacing: '-0.02em' }],
              '6xl': ['3.75rem', { lineHeight: '1.2', letterSpacing: '-0.02em' }],
            },
            screens: {
              xs: '480px',
            },
            borderWidth: {
              3: '3px',
            },
            minWidth: {
              36: '9rem',
              44: '11rem',
              56: '14rem',
              60: '15rem',
              72: '18rem',
              80: '20rem',
            },
            maxWidth: {
              '8xl': '88rem',
              '9xl': '96rem',
            },
            zIndex: {
              60: '60',
            },
            content: {
              'dot': "'·'",
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
