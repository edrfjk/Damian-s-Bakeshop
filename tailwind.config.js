/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                golden: {
                    light:   '#e8a020',
                    DEFAULT: '#c8860a',
                    dark:    '#9a6508',
                },
                chocolate: {
                    light:   '#6b3a1f',
                    DEFAULT: '#3d1f0a',
                },
                rose:    { DEFAULT: '#d4847a', light: '#f0c4bc' },
                cream:   { DEFAULT: '#fdf6ec', soft: '#faf0e0', parchment: '#f5e6c8' },
                sage:    { DEFAULT: '#7a9e7e' },
            },
            fontFamily: {
                display: ['"Playfair Display"', 'serif'],
                sans:    ['Lato', 'sans-serif'],
                script:  ['"Dancing Script"', 'cursive'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};