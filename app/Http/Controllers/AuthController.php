<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use  App\Models\Item;
use App\Models\Category;
class AuthController extends Controller
{
    public function checkAuth($kategori = null)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            } else {
                $category = Category::all();
                $activeCategory = "";
                try {
                    if ($kategori !== null) {
                        $idKategori = Crypt::decrypt($kategori);

                        $selectedCategory = Category::find($idKategori);
                        $activeCategory = $selectedCategory['name'];
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

                return view('home', compact('category','activeCategory', 'barang'));
            }
        }

        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials )) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau Password Salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
