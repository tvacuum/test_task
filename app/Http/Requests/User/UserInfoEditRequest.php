<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            "firstname"   => ["required", "string"],
            "lastname"    => ["required", "string"],
            "email"       => ["required", "string", 'unique:users,email,' . Auth::id()],
            "phone"       => ["required", "string", 'unique:users,phone,' . Auth::id()],
            "birthday"    => ["required", "string", "date_format:Y-m-d"],
            "quote"       => ["required", "string"],
            "telegram_id" => ["required", "string", 'unique:users,telegram_id,' . Auth::id()]
        ];
    }
}
