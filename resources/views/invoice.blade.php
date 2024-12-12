@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Invoice Anda</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Invoice Card 1 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-semibold text-gray-500">Invoice #INV-2023-001</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Lunas</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">PT Maju Jaya</h2>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">15 Des 2023</span>
                    <span class="text-lg font-bold text-blue-600">Rp 6.105.000</span>
                </div>
            </div>
        </div>

        <!-- Invoice Card 2 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-semibold text-gray-500">Invoice #INV-2023-002</span>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">CV Sejahtera</h2>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">20 Des 2023</span>
                    <span class="text-lg font-bold text-blue-600">Rp 4.500.000</span>
                </div>
            </div>
        </div>

        <!-- Invoice Card 3 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-semibold text-gray-500">Invoice #INV-2023-003</span>
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs rounded-full">Jatuh Tempo</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">UD Lancar</h2>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">25 Des 2023</span>
                    <span class="text-lg font-bold text-blue-600">Rp 7.200.000</span>
                </div>
            </div>
        </div>

        <!-- Invoice Card 4 -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm font-semibold text-gray-500">Invoice #INV-2023-004</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Lunas</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">PT Berkah Abadi</h2>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">30 Des 2023</span>
                    <span class="text-lg font-bold text-blue-600">Rp 5.750.000</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8">
        <nav class="inline-flex rounded-md shadow">
            <a href="#" class="px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Sebelumnya
            </a>
            <a href="#" class="ml-3 px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Selanjutnya
            </a>
        </nav>
    </div>
</div>

@endsection