<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname'   => fake()->name(),
            'lastname'    => fake()->lastName(),
            'email'       => fake()->unique()->email(),
            'phone'       => fake()->unique()->e164PhoneNumber(),
            'password'    => Hash::make('163264'),
            'birthday'    => fake()->date(),
            'quote'       => fake()->realText(),
            'photo'       => fake()->filePath(),
            'telegram_id' => fake()->numberBetween(9000000000, 9999999999)
        ];
    }
}
