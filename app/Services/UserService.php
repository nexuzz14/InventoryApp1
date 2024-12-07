<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

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
        if ($data["password"]) {
            $data["password"] = bcrypt($data["password"]);
        }else{
            $data["password"] = User::find($id)->password;
        }

        return User::find($id)->update($data);
    }

    public function deleteUser($id)
    {
        $id = Crypt::decrypt($id);
        return User::find($id)->delete();
    }
}