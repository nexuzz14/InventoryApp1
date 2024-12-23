<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboardData = DB::table('categories')
            ->selectRaw('
                COUNT(DISTINCT categories.id) as totalCategories,
                (SELECT COUNT(*) FROM suppliers) as totalSuppliers,
                (SELECT COUNT(*) FROM items) as totalItems,
                (SELECT COUNT(*) FROM request_items) as totalRequests
            ')
            ->first();
        $topItems = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->select('items_request_details.item_id', 'items.name')
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy(DB::raw('SUM(items_request_details.quantity)'), 'desc')
            ->get();
    
        $lowStockItems = DB::table('items')
            ->select('id', 'name', 'quantity')
            ->where('quantity', '<', 10)
            ->orderBy('quantity', 'asc') 
            ->get();
        return response()->json([
            'category' => $dashboardData->totalCategories,
            'suppliers' => $dashboardData->totalSuppliers,
            'items' => $dashboardData->totalItems,
            'totalRequest' => $dashboardData->totalRequests,
            'topItems' => $topItems,
            'lowStockItems' => $lowStockItems 
        ]);
    }
    
}
