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


    public function store(StoreCategoryRequest $category)
    {
        $result = $this->categoryServices->storeCategory($category->request->all());
        if (!$result) {
            return  response()->json([
                "messages" => "Gagal menambah kategori"
            ]);
        }
        return  response()->json([
            "messages" => "berhasil menambah kategori"
        ]);
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




    public function update(Request $request)
    {
        $result = $this->categoryServices->updateCategory($request->id, $request->name);
        if (!$result) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengubah kategori' . $request->name
            ]);
        }
        return response()->json([
            'messages' => 'berhasil mengubah kategori'
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryServices->deleteCategory($request->id);
        if (!$result) {
            return response()->json([
                'messages' => 'gagal menghapus kategori'
            ], 200);
        }
        return response()->json([
            'messages' => 'berhasil menghapus kategori'
        ]);
    }
}
