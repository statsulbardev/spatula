const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    100: "#B6E0FE",
                    200: "#84C5F4",
                    300: "#62B0E8",
                    400: "#4098D7",
                    500: "#2680C2",
                    600: "#186FAF",
                },
                secondary: {
                    100: "#FFF3C4",
                    200: "#FCE588",
                    300: "#FADB5F",
                    400: "#F7C948",
                    500: "#F0B429",
                    600: "#DE911D",
                    900: "#8D2B0B",
                },
                neutral: {
                    000: "#F0F4F8",
                    100: "#D9E2EC",
                    200: "#BCCCDC",
                    300: "#9FB3C8",
                    400: "#829AB1",
                    500: "#627D98",
                    600: "#486581",
                },
                supportcyan: {
                    400: "#38BEC9",
                },
                supportred: {
                    400: "#D64545",
                },
            },
            boxShadow: theme => ({
                outline: '0 0 0 2px' + theme('colors.primary.400'),
            }),
            fill: theme => theme('colors'),
        },
    },
    variants: {
        fill: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        zIndex: ['responsive', 'focus'],
    },
    plugins: []
}
