<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function updateUser($id, $data)
    {
        if (isset($data["password"])) {
            $data["password"] = bcrypt($data["password"]);
        }else{
            $data["password"] = User::find($id)->password;
        }
        Log::debug($data['role']);
        return User::find($id)->update($data);
    }

    public function deleteUser($id)
    {
        $id = Crypt::decrypt($id);
        return User::find($id)->delete();
    }
}