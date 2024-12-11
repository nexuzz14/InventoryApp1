@extends('layouts.app')
@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 sm:p-8">
    <div class="flex flex-col sm:flex-row justify-between mb-6">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl font-bold text-gray-800">PT Solusi Digital</h1>
            <p class="text-sm text-gray-600">Jl. Senayan No. 45, Jakarta</p>
            <p class="text-sm text-gray-600">hello@solusidigital.com</p>
        </div>
        <div class="text-left sm:text-right">
            <h2 class="text-xl font-semibold text-gray-700">INVOICE</h2>
            <p class="text-sm">No. INV-2024-001</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div>
            <h3 class="font-semibold text-gray-700">Tagihan Untuk:</h3>
            <p class="text-sm">PT Maju Jaya</p>
            <p class="text-sm">Jl. Sudirman No. 123, Jakarta</p>
        </div>
        <div class="text-left sm:text-right">
            <p class="text-sm">
                <span class="font-semibold">Tanggal Invoice:</span> 11 Desember 2024
            </p>
            <p class="text-sm">
                <span class="font-semibold">Jatuh Tempo:</span> 25 Desember 2024
            </p>
        </div>
    </div>

    <table class="w-full mb-6 border-collapse text-sm sm:text-base">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Deskripsi</th>
                <th class="border p-2 text-center">Kuantitas</th>
                <th class="border p-2 text-right">Harga Satuan</th>
                <th class="border p-2 text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border p-2">Layanan Desain Website</td>
                <td class="border p-2 text-center">1</td>
                <td class="border p-2 text-right">Rp 5.000.000</td>
                <td class="border p-2 text-right">Rp 5.000.000</td>
            </tr>
            <tr>
                <td class="border p-2">Hosting Tahunan</td>
                <td class="border p-2 text-center">1</td>
                <td class="border p-2 text-right">Rp 1.200.000</td>
                <td class="border p-2 text-right">Rp 1.200.000</td>
            </tr>
        </tbody>
    </table>

    <div class="text-right text-sm sm:text-base">
        <div class="flex justify-between sm:justify-end mb-2">
            <span class="sm:mr-4">Subtotal:</span>
            <span>Rp 6.200.000</span>
        </div>
        <div class="flex justify-between sm:justify-end mb-2">
            <span class="sm:mr-4">Pajak (10%):</span>
            <span>Rp 620.000</span>
        </div>
        <div class="flex justify-between sm:justify-end font-bold text-lg">
            <span class="sm:mr-4">Total:</span>
            <span>Rp 6.820.000</span>
        </div>
    </div>

    <div class="mt-6 text-center text-sm text-gray-600">
        <p>Terima kasih atas bisnis Anda</p>
        <p>Silakan hubungi kami jika Anda memiliki pertanyaan</p>
    </div>
</div>

@endsection