import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/dashboard/*",
        "./resources/views/user/*",
        "./resources/views/auth/login.blade.php",
        "./resources/views/layouts/navigation.blade.php",
        "./resources/views/layouts/app.blade.php",
        "./resources/views/dashboard/supplier.blade.php",
        "./resources/views/components/notivication-handler.blade.php",
        "./resources/views/welcome.blade.php",
        "./resources/views/home.blade.php",
        "./resources/views/invoice.blade.php",
        "./resources/views/components/sidebar.blade.php"
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
