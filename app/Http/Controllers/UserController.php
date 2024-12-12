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
    public function update(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->id);

            $data = $request->validate([
                "data.username" => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('users', 'username')->ignore($id),
                ],
                "data.name" => 'required|string',
                "data.email" => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($id),
                ],
                "data.role" => 'required|string|in:user,admin',
                "data.password" => 'nullable|string|max:255',
            ]);


            $result = $this->userService->updateUser($id, $data);
            if (!$result) {

                return redirect()->back()->with("message", "Terjadi kesalahan saat mengubah data");

            }
            return redirect()->back()->with("message", "berhasil");

        } catch (ValidationException $e) {
            $messages = collect($e->errors())
                ->flatten()
                ->join(' '); // Gabungkan error dengan spasi atau karakter lain

            return redirect()->back()->with('message', $messages)->withInput();
        } catch (\Exception $e) {
            Log::debug("ini eror, $e");

            return redirect()->back()->with('message', 'Terjadi kesalahan');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->userService->deleteUser($id);

        if (!$result) {
            return redirect()->back()->with("message", "Terjadi kesalahan saat menghapus");
        } else {
            return redirect()->back()->with("message", "Berhasil menghapus");
        }
    }
}
