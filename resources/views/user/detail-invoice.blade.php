@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row justify-between mb-6">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-800">PT Tiga Lintang Suminar</h1>
                <p class="text-sm text-gray-600">Jl. Gumuk Indah No.A39, Yogyakarta</p>
                {{-- <p class="text-sm text-gray-600">hello@solusidigital.com</p> --}}
            </div>
            <div class="text-left sm:text-right">
                <h2 class="text-xl font-semibold text-gray-700">INVOICE</h2>
                <p class="text-sm">No. INV-{{ $invoice['created_at']->format('Y') }}-{{ $invoice['id']}}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <h3 class="font-semibold text-gray-700">Tagihan Untuk:</h3>
                <p class="text-sm">{{ $invoice['request_item']['nama_pemohon']}}</p>
            </div>
            <div class="text-left sm:text-right">
                <p class="text-sm">
                    <span class="font-semibold">Tanggal Invoice Dibuat:</span> {{ $invoice['created_at']->format('d F Y') }}
                </p>
                {{-- <p class="text-sm">
                <span class="font-semibold">Jatuh Tempo:</span> 25 Desember 2024
            </p> --}}
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
                @foreach ($invoice['request_item']['request_details'] as $item)
                    <tr>
                        <td class="border p-2">{{ $item['item']['name'] }}</td>
                        <td class="border p-2 text-center">{{ $item['quantity'] }}</td>
                        <td class="format-price border p-2 text-right" data-price="{{ $item['item']['price'] }}">Rp </td>
                        <td class="format-price border p-2 text-right"
                            data-price="{{ $item['item']['price'] * $item['quantity'] }}">Rp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right text-sm sm:text-base">
            {{-- <div class="flex justify-between sm:justify-end mb-2">
                <span class="sm:mr-4">Subtotal:</span>
                <span>Rp 6.200.000</span>
            </div>
            <div class="flex justify-between sm:justify-end mb-2">
                <span class="sm:mr-4">Pajak (10%):</span>
                <span>Rp 620.000</span>
            </div> --}}
            <div class="flex justify-between sm:justify-end font-bold text-lg">
                <span class="sm:mr-4">Total:</span>
                <span class="format-price" data-price="{{ $invoice['total_price'] }}">Rp </span>
            </div>
        </div>

        <div class="mt-6 text-center text-sm text-gray-600">
            <p>Terima kasih atas kepercayaan Anda</p>
            <p>Silakan hubungi kami jika Anda memiliki pertanyaan</p>
        </div>
    </div>
    <script>
        document.querySelectorAll('.format-price').forEach(el => {
            const price = parseFloat(el.dataset.price);
            el.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        });
    </script>

    {{-- <div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Invoice</h1>
                <div class="text-right">
                    <p class="font-semibold">Invoice #INV-2023-001</p>
                    <p class="text-sm">Tanggal: 15 Desember 2023</p>
                </div>
            </div>
        </div>

        <div class="p-6 border-b">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h2 class="font-semibold text-gray-700">Tagihan Untuk:</h2>
                    <p class="text-gray-600">PT Maju Jaya</p>
                </div>
                <div class="text-right">
                    <h2 class="font-semibold text-gray-700">Dari:</h2>
                    <p class="text-gray-600">PT Tiga Lintang Suminar</p>
                    <p class="text-gray-600">Jl. Alamat No. 456</p>
                    <p class="text-gray-600">Yogyakarta, Indonesia</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 text-left">Deskripsi</th>
                        <th class="p-3 text-center">Kuantitas</th>
                        <th class="p-3 text-right">Harga Satuan</th>
                        <th class="p-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3 text-gray-600">Jasa Konsultasi</td>
                        <td class="p-3 text-center">2</td>
                        <td class="p-3 text-right">Rp 2.500.000</td>
                        <td class="p-3 text-right">Rp 5.000.000</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-gray-600">Biaya Tambahan</td>
                        <td class="p-3 text-center">1</td>
                        <td class="p-3 text-right">Rp 500.000</td>
                        <td class="p-3 text-right">Rp 500.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t">
            <div class="flex justify-end">
                <div class="w-64">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">Rp 5.500.000</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">PPN (11%)</span>
                        <span class="font-semibold">Rp 605.000</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span class="text-lg font-bold">Total</span>
                        <span class="text-lg font-bold text-blue-600">Rp 6.105.000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-6 text-center">
            <p class="text-gray-600 mb-2">Terima kasih atas kepercayaan Anda</p>
            <p class="text-sm text-gray-500">Invoice ini dibuat secara elektronik dan valid tanpa tanda tangan basah</p>
        </div>

        <div class="p-4 text-center">
            <button class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 print:hidden">
                Cetak Invoice
            </button>
        </div>
    </div>
</div> --}}
@endsection
