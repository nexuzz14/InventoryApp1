import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/dashboard/*",
        "./resources/views/auth/login.blade.php",
        "./resources/views/layouts/navigation.blade.php",
        "./resources/views/dashboard/supplier.blade.php",
        "./resources/views/components/notivication-handler.blade.php",
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
