<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "supplier_id" => "required|exists:suppliers,id",
            "category_id" => "required|exists:categories,id",
            "unit_id" => "required|exists:units,id",
            // "location_id" => "required|exists:locations,id",
            "quantity" => "required|numeric",
            "status" => "required|in:tersedia, tidak tersedia",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "source" => "required|in:manual, purchasing",
            "price" => "required|numeric",
        ];
    }
}
