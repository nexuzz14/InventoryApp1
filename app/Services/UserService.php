<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;

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
        }

        return User::find($id)->update($data);
    }

    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }
}