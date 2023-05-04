<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeReport>
 */
class TimeReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'         => fake()->numberBetween(1,3),
            'date'            => fake()->unique('date')->dateTimeBetween(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth())->format('Y-m-d'),
            'time_start'      => fake()->time('H:i:s', '20:00:00'),
            'time_end'        => fake()->time('H:i:s', '12:00:00'),
            'total_timebreak' => fake()->randomFloat(2,0, 1.1),
            'total'           => fake()->randomFloat(2,0, 1.1),
            'without_lunch'   => fake()->boolean(),
            'forgot_flag'     => fake()->boolean(),
            'comment'         => fake()->realText(),
            'workplace_id'    => fake()->numberBetween(1,2)
        ];
    }
}
