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
    
        $topItemsLastMonth = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id')
            ->select('items_request_details.item_id', 'items.name', DB::raw('SUM(items_request_details.quantity) as total_quantity'))
            ->where('request_items.created_at', '>=', now()->subMonth())
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('total_quantity', 'desc')
            ->get();
    
        $topItemsLastYear = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id')
            ->select('items_request_details.item_id', 'items.name', DB::raw('SUM(items_request_details.quantity) as total_quantity'))
            ->where('request_items.created_at', '>=', now()->subYear())
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('total_quantity', 'desc')
            ->get();
    
        $mostRequestedItemsLastMonth = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id')
            ->select('items_request_details.item_id', 'items.name', DB::raw('COUNT(items_request_details.id) as request_count'))
            ->where('request_items.created_at', '>=', now()->subMonth())
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('request_count', 'desc')
            ->get();
    
        $mostRequestedItemsLastYear = DB::table('items_request_details')
            ->join('items', 'items.id', '=', 'items_request_details.item_id')
            ->join('request_items', 'request_items.id', '=', 'items_request_details.request_id')
            ->select('items_request_details.item_id', 'items.name', DB::raw('COUNT(items_request_details.id) as request_count'))
            ->where('request_items.created_at', '>=', now()->subYear())
            ->groupBy('items_request_details.item_id', 'items.name')
            ->orderBy('request_count', 'desc')
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
            'topItemsLastMonth' => $topItemsLastMonth,
            'topItemsLastYear' => $topItemsLastYear,
            'mostRequestedItemsLastMonth' => $mostRequestedItemsLastMonth,
            'mostRequestedItemsLastYear' => $mostRequestedItemsLastYear,
            'lowStockItems' => $lowStockItems
        ]);
    }
    
}
