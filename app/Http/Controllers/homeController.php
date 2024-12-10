<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Services\CategoryService;
use App\Services\ItemService;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    protected $categoryService;
    protected $itemService;
    public function __construct(CategoryService $categoryService, ItemService $itemService)
    {
        $this->itemService = $itemService;
        $this->categoryService = $categoryService;
    }
    public function create($kategori = null)
    {
        $category = Category::all();

        try {
            if ($kategori !== null) {
                $idKategori = Crypt::decrypt($kategori);

                $selectedCategory = $this->categoryService->getCategoryById($idKategori);
                if ($selectedCategory) {
                    $barang = $this->itemService->getItemsByCategoryId($idKategori);
                } else {
                    $barang = $this->itemService->getAllItems();
                }
            } else {
                $barang = $this->itemService->getAllItems();
            }
        } catch (\Exception $e) {
            $barang = $this->itemService->getAllItems();
        }

        return view('home', compact('category', 'barang'));
    }
}
