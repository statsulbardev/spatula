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
                    100: "#CBBBE9",
                    200: "#B49DDF",
                    300: "#9D7ED5",
                    400: "#8660CB",
                    500: "#6F42C1",
                    600: "#5D37A2",
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
            zIndex: {
                999999: "999999",
                99999: "99999",
                9999: "9999",
                999: "999",
                99: "99",
                9: "9",
                1: "1",
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
