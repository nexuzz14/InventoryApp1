<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menggabungkan query untuk mendapatkan semua data yang dibutuhkan
        $dashboardData = DB::table('categories')
            ->selectRaw('
                COUNT(DISTINCT categories.id) as totalCategories,
                (SELECT COUNT(*) FROM suppliers) as totalSuppliers,
                (SELECT COUNT(*) FROM items) as totalItems,
                (SELECT COUNT(*) FROM request_items) as totalRequests
            ')
            ->first();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'category' => $dashboardData->totalCategories,
            'suppliers' => $dashboardData->totalSuppliers,
            'items' => $dashboardData->totalItems,
            'totalRequest' => $dashboardData->totalRequests,
        ]);
    }
}
