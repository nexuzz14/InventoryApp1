<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use  App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Carbon\Carbon;
use Illumminate\Support\Fascade\Cookie;

class AuthController extends Controller
{
    public function checkAuth()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            } else {
                $category = Category::all();
                // $activeCategory = "";
                // try {
                //     if ($kategori !== null) {
                //         $idKategori = Crypt::decrypt($kategori);

                //         $selectedCategory = Category::find($idKategori);
                //         $activeCategory = $selectedCategory['name'];
                //         if ($selectedCategory) {
                //             $barang = Item::where('category_id', $idKategori)->get();
                //         } else {
                //             $barang = Item::all();
                //         }
                //     } else {
                //         $barang = Item::all();
                //     }
                // } catch (\Exception $e) {
                // }
                $barang = Item::all();

                return view('home', compact('category', 'barang'));
            }
        }

        return view('welcome');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $expiryTime = 1440; // Same as cookie expiration time in minutes
            $token = $user->createToken('auth_token', ['*'], Carbon::now()->addMinutes($expiryTime));
            $cookie = cookie('auth_token', $token->plainTextToken, 1440, '/', null, true, true, false, 'Strict');
            return response()->json([
                'message' => 'Berhasil',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'token' => $token->plainTextToken,
                ],
            ])->cookie($cookie);
        }

        return response()->json([
            'message' => 'Email atau Password Salah',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
