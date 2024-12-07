<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\LocationService;
use App\Services\SupplierService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    protected $categoryService;
    protected $unitService;
    protected $supplierService;
    protected $locationService;

    public function __construct(CategoryService $categoryService, UnitService $unitService, SupplierService $supplierService, LocationService $locationService)
    {
        $this->categoryService = $categoryService;
        $this->unitService = $unitService;
        $this->supplierService = $supplierService;
        $this->locationService = $locationService;
    }

    public function getAllMasterData()
    {
        $categories = $this->categoryService->getAllCategory();
        $units = $this->unitService->getAllUnits();
        $suppliers = $this->supplierService->getAllSuppliers();
        $locations = $this->locationService->getAllLocations();
        return response()->json(['categories' => $categories, 'units' => $units, 'suppliers' => $suppliers, 'locations' => $locations]);
    }
}
