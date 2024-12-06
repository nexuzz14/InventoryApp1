<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-sans">
    <!-- Header -->
    <header class="bg-gray-800 sticky top-0 z-50 shadow-md">
        <div class="max-w-6xl mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-3xl font-extrabold text-blue-400">Inventory</h1>
            <nav class="space-x-4">
                <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Login</a>
                <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold py-2 px-4 rounded">Register</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto py-10 px-6 space-y-12">
        <!-- Welcome Section -->
        <section class="flex flex-col md:flex-row items-center gap-8">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-bold mb-4">Welcome to Inventory</h2>
                <p class="text-gray-400">Easily manage your products and supplies with our user-friendly platform. Stay organized and save time with our powerful tools.</p>
            </div>
            <div class="md:w-1/2">
                <img src="https://via.placeholder.com/400x300" alt="Inventory Illustration" class="rounded-lg shadow-lg">
            </div>
        </section>


        <!-- Product Categories -->
        <section>
            <h3 class="text-3xl font-bold mb-6">Product Categories</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/100" alt="Electronics" class="w-20 h-20 object-cover rounded-full mb-4">
                    <h4 class="text-xl font-medium">Electronics</h4>
                </div>
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/100" alt="Furniture" class="w-20 h-20 object-cover rounded-full mb-4">
                    <h4 class="text-xl font-medium">Furniture</h4>
                </div>
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/100" alt="Office Supplies" class="w-20 h-20 object-cover rounded-full mb-4">
                    <h4 class="text-xl font-medium">Office Supplies</h4>
                </div>
                <div class="bg-gray-800 rounded-lg p-6 flex flex-col items-center shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/100" alt="Apparel" class="w-20 h-20 object-cover rounded-full mb-4">
                    <h4 class="text-xl font-medium">Apparel</h4>
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section>
            <h3 class="text-3xl font-bold mb-6">Featured Products</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/150" alt="Product 1" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium">Product 1</h4>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/150" alt="Product 2" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium">Product 2</h4>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/150" alt="Product 3" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium">Product 3</h4>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://via.placeholder.com/150" alt="Product 4" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium">Product 4</h4>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    {{-- <footer class="bg-gray-800 py-6">
        <div class="max-w-6xl mx-auto text-center text-gray-400">
            &copy; 2024 Inventory. All rights reserved.
        </div>
    </footer> --}}
</body>
</html>
