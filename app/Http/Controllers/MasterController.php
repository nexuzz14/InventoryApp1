<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\SupplierService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    protected $categoryService;
    protected $unitService;
    protected $supplierService;

    public function __construct(CategoryService $categoryService, UnitService $unitService, SupplierService $supplierService)
    {
        $this->categoryService = $categoryService;
        $this->unitService = $unitService;
        $this->supplierService = $supplierService;
    }

    public function getAllMasterData()
    {
        $categories = $this->categoryService->getAllCategory();
        $units = $this->unitService->getAllUnits();
        $suppliers = $this->supplierService->getAllSuppliers();
        return response()->json(['categories' => $categories, 'units' => $units, 'suppliers' => $suppliers]);
    }
}
