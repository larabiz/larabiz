const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        container: {
            center: true,
            padding: '1rem',
        },

        extend: {
            fontFamily: {
                sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans],
            },
        },

        screens: {
            xs: '480px',
            sm: '568px',
            md: '768px',
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
    ],
}
