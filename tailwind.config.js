const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*ExpedientTable.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            backgroundImage: theme => ({
                'office': "url('/img/backgrounds/login.jpg')",
            }),
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    darkest: '#582404',
                    dark: '#9c411a',
                    DEFAULT: '#9c411a',
                    light: '#bb4d22',
                    lightest: '#de592a',
                },
                secondary: {
                    darkest: '#32CFCC',
                    dark: '#34D9A7',
                    DEFAULT: '#38C172',
                    light: '#34D94A',
                    lightest: '#4ECF32',
                },
            },
            // backgroundImage: theme => ({
            //    'office': "url('/img/backgrounds/login.jpg",
            // }),
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],

        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
