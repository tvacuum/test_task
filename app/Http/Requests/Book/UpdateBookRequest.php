<?php

namespace App\Http\Requests\Book;


use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateBookRequest extends FormRequest
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
            "title"       => ["required", "string"],
            "slug"        => ["required", "string", "unique:books,slug," . Request::instance()->id],
            "author_id"   => ["required", "numeric"],
            "description" => ["required", "string"],
            "rating"      => ["required", "numeric", "min:0", "max:5"]
        ];
    }
}
