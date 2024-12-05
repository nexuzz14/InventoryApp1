import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/dashboard/kategori.blade.php",
        "./resources/views/auth/login.blade.php",
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
