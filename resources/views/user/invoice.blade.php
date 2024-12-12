@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Invoice Anda</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($invoice as $item)
                <a href="{{ route('invoice.detail', ['id' => $item['id']]) }}"
                    class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-semibold text-gray-500">Invoice
                                #INV-{{ $item['created_at']->format('Y') }}-{{ $item['id'] }}</span>
                            <span
                                class="px-3 py-1 bg-{{ $item['status'] == 'paid' ? 'green' : 'red' }}-100 text-{{ $item['status'] == 'paid' ? 'green' : 'red' }}-800 text-xs rounded-full">{{ $item['status'] }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $item['request_item']['nama_pemohon'] }}</h2>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $item['created_at']->format('d M Y') }}</span>
                            <span class="format-price text-lg font-bold text-blue-600"
                                data-price="{{ $item['total_price'] }}"></span>
                        </div>
                    </div>
                </a>
            @endforeach
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
@endsection
