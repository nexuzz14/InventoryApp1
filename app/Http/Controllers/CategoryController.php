<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    protected $categoryServices;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryServices = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryServices->getAllCategory();
        return view('dashboard.kategori', compact('categories'));
    }


    public function store(StoreCategoryRequest $request)
    {

        $data = $request->validated();

        $result = $this->categoryServices->storeCategory($data);

        if (!$result) {
            return response()->json([
                "status" => "error",
                "message" => "Gagal menambah kategori"
            ], 422);
        }

        return response()->json([
            "status" => "success",
            "message" => "Berhasil menambah kategori"
        ], 201);
    }




    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('categories')->count();

            $data = DB::table('categories')->get();
            return response()->json([
                'recordsTotal' => $totalRecords,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengambil data kategori',
                'error' => $e->getMessage()
            ]);
        }
    }




    public function update(UpdateCategoryRequest $request)
    {
        $result = $this->categoryServices->updateCategory($request->id, $request->name);
        if (!$result) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengubah kategori' . $request->name
            ],404);
        }
        return response()->json([
            'messages' => 'Berhasil mengubah kategori'
        ],200);
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryServices->deleteCategory($request->id);
        if (!$result) {
            return response()->json([
                'messages' => 'Gagal menghapus kategori'
            ], 404);
        }
        return response()->json([
            'messages' => 'Berhasil menghapus kategori'
        ], 200);
    }
}
