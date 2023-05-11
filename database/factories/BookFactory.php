<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(2);

        return [
            'title'       => $title,
            'slug'        => Str::slug($title),
            'author_id'   => fake()->randomElement(Author::all()),
            'description' => fake()->text(),
            'rating'      => fake()->randomFloat(2, 0, 5),
            'cover'       => fake()->filePath()
        ];
    }
}
