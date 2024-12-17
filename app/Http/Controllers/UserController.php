<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CategoryService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userService;
    protected $transactionService;

    public function __construct(UserService $userService, TransactionService $transactionService)
    {
        $this->userService = $userService;
        $this->transactionService = $transactionService;
    }
    public function index()
    {
        $user = User::all();
        return view('dashboard.pengguna', compact('user'));
    }

    public function getDetailOwnInvoice($id)
    {
        $invoice = $this->transactionService->detailOwnInvoice(base64_decode($id))->toArray();

        if (is_array(reset($invoice))) {
            foreach ($invoice as &$item) {
                $item['id'] = base64_encode($item['id']);
                $item['created_at'] = \Carbon\Carbon::parse($item['created_at']);
            }
        } else {
            $invoice['id'] = base64_encode($invoice['id']);
            $invoice['created_at'] = \Carbon\Carbon::parse($invoice['created_at']);
        }
        // return response()->json($invoice);
        return view('user.detail-invoice', compact('invoice'));
    }
    public function getOwnInvoice()
    {
        $invoice = $this->transactionService->listOwnInvoice(Auth::user()->id)->toArray();
        foreach ($invoice as &$item) {
            $item['id'] = base64_encode($item['id']);
            $item['created_at'] = \Carbon\Carbon::parse($item['created_at']);
        }

        return view('user.invoice', compact('invoice'));
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "username" => 'required|string|max:50|unique:' . User::class,
                "name" => 'required|string',
                "email" => 'required|email|unique:' . User::class,
                "role" => 'required|string|in:admin,user',
                "password" => 'required|string|max:255',
            ]);

            $user = new User();
            $user->username = $data['username'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->password = bcrypt($data['password']); // Enkripsi password
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan!'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Ambil user berdasarkan ID
            $user = User::findOrFail($id);

            // Validasi hanya field yang dikirim (opsional)
            $validatedData = $request->validate([
                'username' => 'sometimes|required|string|max:50|unique:users,username,' . $id,
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'role' => 'sometimes|required|string|in:user,admin',
                'password' => 'sometimes|nullable|string|min:6|max:255',
            ]);

            // Update data sesuai input yang dikirim
            if ($request->has('username')) {
                $user->username = $validatedData['username'];
            }
            if ($request->has('name')) {
                $user->name = $validatedData['name'];
            }
            if ($request->has('email')) {
                $user->email = $validatedData['email'];
            }
            if ($request->has('role')) {
                $user->role = $validatedData['role'];
            }
            if ($request->has('password')) {
                $user->password = Hash::make($validatedData['password']);
            }

            // Simpan perubahan
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
                'data' => $user
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error("Update Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->userService->deleteUser($id);

        if (!$result) {
            return response()->json([
                'message' => 'gagal menghapus akun'
            ]);
        }
        return response()->json([
            'message' => 'berhasil menghapus akun'
        ]);
    }

    public function getData(Request $request)
    {
        try {

            $totalRecords = DB::table('users')->count();

            $data = DB::table('users')
            ->select('id', 'username', 'name', 'email', 'role')
            ->get();
            return response()->json([
                'recordsTotal' => $totalRecords,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => 'Terjadi kesalahan saat mengambil data user',
                'error' => $e->getMessage()
            ]);
        }
    }
}
