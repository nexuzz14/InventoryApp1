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
                "messages"=>"Gagal menambah kategori"
            ]);
        }
        return  response()->json([
            "messages"=>"berhasil menambah kategori"
        ]);
    }



    public function getData(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search')['value'];

        $totalRecords = DB::table('categories')->count();

        $query = DB::table('categories');
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }
        $filteredRecords = $query->count();

        $data = $query->offset($start)->limit($length)->get();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    


    public function update(Request $request)
    {
        $result = $this->categoryServices->updateCategory($request->id, $request->name);
        if (!$result) {
            return response()->json([
                'messages'=>'Terjadi kesalahan saat mengubah kategori' . $request->name
            ]);
        }
        return response()->json([
            'messages'=>'berhasil mengubah kategori'
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryServices->deleteCategory($request->id);
        if (!$result) {
            return response()->json([
                'messages'=>'gagal menghapus kategori'
            ]);
        }
        return response()->json([
            'messages'=>'berhasil menghapus kategori'
        ]);
    }
}
