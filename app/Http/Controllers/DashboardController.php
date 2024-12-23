<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menggabungkan query untuk mendapatkan semua data dashboard
        $dashboardData = DB::table('categories')
            ->selectRaw('
                COUNT(DISTINCT categories.id) as totalCategories,
                (SELECT COUNT(*) FROM suppliers) as totalSuppliers,
                (SELECT COUNT(*) FROM items) as totalItems,
                (SELECT COUNT(*) FROM request_items) as totalRequests
            ')
            ->first();
    
        // Mengambil top items untuk satu bulan terakhir
        $topItemsLastMonth = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id') // Join ke tabel request_items
            ->select('items_request_details.item_id', 'items.name', DB::raw('SUM(items_request_details.quantity) as total_quantity'))
            ->where('request_items.created_at', '>=', now()->subMonth()) // Filter 1 bulan terakhir berdasarkan created_at dari request_items
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('total_quantity', 'desc')
            ->get();
    
        // Mengambil top items untuk satu tahun terakhir
        $topItemsLastYear = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id') // Join ke tabel request_items
            ->select('items_request_details.item_id', 'items.name', DB::raw('SUM(items_request_details.quantity) as total_quantity'))
            ->where('request_items.created_at', '>=', now()->subYear()) // Filter 1 tahun terakhir berdasarkan created_at dari request_items
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('total_quantity', 'desc')
            ->get();
    
        // Mengambil daftar barang dari tabel items yang quantity-nya kurang dari 10
        $lowStockItems = DB::table('items')
            ->select('id', 'name', 'quantity')
            ->where('quantity', '<', 10)
            ->orderBy('quantity', 'asc') // Mengurutkan dari jumlah quantity terkecil
            ->get();
    
        // Mengembalikan data dalam format JSON
        return response()->json([
            'category' => $dashboardData->totalCategories,
            'suppliers' => $dashboardData->totalSuppliers,
            'items' => $dashboardData->totalItems,
            'totalRequest' => $dashboardData->totalRequests,
            'topItemsLastMonth' => $topItemsLastMonth, // Data top items 1 bulan terakhir
            'topItemsLastYear' => $topItemsLastYear,   // Data top items 1 tahun terakhir
            'lowStockItems' => $lowStockItems // Data items dengan quantity < 10
        ]);
    }
    
}
