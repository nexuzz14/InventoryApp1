<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function create($kategori = null)
    {
            
        $category = Category::all();

        try {
            if ($kategori !== null) {
                $idKategori = Crypt::decrypt($kategori);
                
                $selectedCategory = Category::find($idKategori);
                if ($selectedCategory) {
                    $barang = Item::where('category_id', $idKategori)->get();
                } else {
                    $barang = Item::all();
                }
            } else {
                $barang = Item::all();
            }
        } catch (\Exception $e) {
            $barang = Item::all();
        }

        return view('home', compact('category', 'barang'));
    }
}
