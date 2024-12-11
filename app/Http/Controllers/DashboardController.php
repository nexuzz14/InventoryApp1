<?php

namespace App\Http\Controllers;

use App\Charts\HistoryRequestChart;
use App\Charts\MonthlyUsersChart;
use App\Services\CategoryService;
use App\Services\ItemService;
use App\Services\SupplierService;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $categoryService;
    protected $supplierService;
    protected $itemService;
    public function __construct(CategoryService $categoryService, SupplierService $supplierService, ItemService $itemService)
    {
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
        $this->itemService = $itemService;
    }
    public function index(MonthlyUsersChart $chart, HistoryRequestChart $historyRequestChart)
    {
        $category = $this->categoryService->getTotalCategory();
        $suppliers = $this->supplierService->getTotalSuppliers();
        $items = $this->itemService->getTotalItems();
        $totalRequest = DB::table('request_items')->count();
        return view('dashboard', ['chart' => $chart->build(), 'historyRequestChart' => $historyRequestChart->build(), 'category' => $category, 'suppliers' => $suppliers, 'items' => $items, 'totalRequest' => $totalRequest]);
    }
}
