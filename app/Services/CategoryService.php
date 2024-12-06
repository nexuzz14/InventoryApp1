<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class CategoryService
{

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getTotalCategory(): int
    {
        return Category::count();
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function updateCategory($id, $data)
    {
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $id = Crypt::decrypt($id);
        return Category::find($id)->delete();
    }
}