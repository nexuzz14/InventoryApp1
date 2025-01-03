<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Item;

class UpdateItemRequest extends FormRequest
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
            "id" => "required|integer", // ID wajib ada dan bertipe integer
            "name" => [
                "required",
                "string",
                Rule::unique(Item::class)->ignore($this->id), // Pengecualian ID untuk pembaruan
            ],
            "uniq_id" => [
                "required",
                "string",
                Rule::unique(Item::class)->ignore($this->id), // Pengecualian ID untuk pembaruan
            ],
            "category_id" => "required|integer|exists:categories,id",
            "quantity" => "required|integer|min:0",
            "unit_id" => "required|integer|exists:units,id",
            "description" => "nullable|string",
            "price" => "required|numeric|min:0",
            "locations" => "array",
            "locations.*.location_id" => "required|integer|exists:locations,id",
            "locations.*.quantity" => "required|integer|min:0",
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Validation\ValidationException
     */
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
