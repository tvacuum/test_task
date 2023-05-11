<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateBookRequest extends FormRequest
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
            "slug"        => ["required", "string", "unique:books,slug"],
            "author_id"   => ["required", "numeric"],
            "description" => ["required", "string"],
            "rating"      => ["required", "numeric", "min:0", "max:5"],
            "cover"       => ["required", "image:jpg,jpeg,png"]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'    => 'Title is required',
            'slug.unique'       => 'Slug should be unique',
            'author_id.numeric' => 'Author_id should be numeric',
            'rating.numeric'    => 'Should be float from 0,00 to 5,00',
            'cover.image'       => 'Should be image type: jpg, jpeg, png'
        ];
    }
}
