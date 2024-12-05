<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {
    public function getAllCategory(){
        return Category::all();
    }

    public function createCategory(array $data){
        return Category::create($data);
    }

    public function getCategoryById($id){
        return Category::find($id);
    }

    public function updateCategory($id, $data){
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id){
        return Category::find($id)->delete();
    }
}