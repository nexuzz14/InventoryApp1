<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Item;

class StoreItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                Rule::unique(Item::class),
            ],
            "uniq_id" => [
                "required",
                "string",
                Rule::unique(Item::class),
            ],
            "category_id" => "required|integer|exists:categories,id",
            "unit_id" => "required|integer|exists:units,id",
            "quantity" => "required|integer|min:0",
            "description" => "nullable|string",
            "price" => "required|numeric|min:0",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
