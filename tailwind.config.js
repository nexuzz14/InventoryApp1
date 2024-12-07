import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/dashboard/*",
        "./resources/views/auth/login.blade.php",
        "./resources/views/layouts/navigation.blade.php",
        "./resources/views/dashboard/supplier.blade.php",
    ],
    safelist: [
        {
            pattern: /^tailwind-scope/,
        },
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
