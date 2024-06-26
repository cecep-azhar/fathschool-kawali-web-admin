const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
const rtlcss = require('rtlcss');

/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: "jit",
    darkMode: "class",
    // important: true,
    // darkMode: ['class', '[data-mode="dark"]'],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "node_modules/preline/dist/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans]
            },
            borderWidth: ["hover"],
            colors: {
                "blue-gray": colors.slate,
                grape: colors.purple
            }
        }
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/line-clamp"),
        require("flowbite/plugin"),
        require("@tailwindcss/aspect-ratio"),
        require("preline/plugin"),
        {
            // ...
            postcssPlugin: 'rtl',
            // Wrap the function in an object with the `AtRule` method.
            AtRule: rtlcss.configure().postcss,
        },
    ]
};