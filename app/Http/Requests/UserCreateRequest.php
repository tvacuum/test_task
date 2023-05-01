<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "firstname"     => ["required", "string"],
            "lastname"      => ["required", "string"],
            "email"         => ["required", "string", "unique:users,email"],
            "phone"         => ["required", "string", "unique:users,phone"],
            "password"      => ["required", "string", "min:6", "confirmed"],
            "birthday"      => ["required", "date"],
            "photo"         => ["required", "image:jpg,jpeg,png"],
        ];
    }
}
