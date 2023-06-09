<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoEditRequest extends FormRequest
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
            "id"        => ["required", "int"],
            "firstname" => ["required", "string"],
            "lastname"  => ["required", "string"],
            "email"     => ["required", "string", 'unique:users,email,' . Request::instance()->id],
            "phone"     => ["required", "string", 'unique:users,phone,' . Request::instance()->id]
        ];
    }
}
