<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

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
            return back()->withErrors([
                "Terjadi kesalahan saat membuat kategori"
            ]);
        }
        return redirect()->route('dashboard.category');
    }



    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // dd($category);
    }


    public function update(Request $request)
    {
       $result =  $this->categoryServices->updateCategory($request->id, $request->name);
       if (!$result) {
           return back()->withErrors([
               "Terjadi kesalahan saat mengubah kategori"
           ]);
       }
       return redirect()->route('dashboard.category');
    }

    public function destroy( $id)
    {
        $result = $this->categoryServices->deleteCategory($id);
        if (!$result) {
            return back()->withErrors([
                "Terjadi kesalahan saat menghapus kategori"
            ]);
        }
        return redirect()->route('category');
    }
}
