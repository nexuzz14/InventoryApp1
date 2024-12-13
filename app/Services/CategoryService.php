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

    public function storeCategory(array $data)
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
        
        if ($category) {
            $category->update([
                "name" => $data
            ]);
            return true;
        }
        return false;
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        if($data){
            $data->delete();
            return true;

        }else{
            return false;
        }
    }
}