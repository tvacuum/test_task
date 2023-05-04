<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
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
            "position_id"   => ["required", "numeric"]
        ];
    }
}
