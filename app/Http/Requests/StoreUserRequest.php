<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "username" => "required|string|unique:" . User::class,
            "email" => "required|string|unique:" . User::class,
            "password" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "role" => "required|in:superadmin, admin, user",
        ];
    }
}
