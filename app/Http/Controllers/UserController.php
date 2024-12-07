<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\UserService;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function index($role = null)
    {
        $roles =  $role === "admin" ? "admin" : "customer";

        $user = User::latest()->where("role", $roles)->get();
        return view('dashboard.pengguna', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "username" => 'required|string|max:50|unique:' . User::class,
            "name" => 'required|string',
            "email" => 'required|email|unique:' . User::class,
            "role" => 'required|string|in:admin,customer',
            "password" => 'required|string|max:255',
        ]);

        $user = new User();
        $user->username = $data['username'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->password = bcrypt($data['password']); // Enkripsi password
        $user->save();

        return redirect()->back()->with('message', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->userService->deleteUser($id);

        if(!$result){
            return redirect()->back()->with("message",  "Terjadi kesalahan saat menghapus");
        }else{
            return redirect()->back()->with("message",  "Berhasil menghapus");
        }
    }
}
