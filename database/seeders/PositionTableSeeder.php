<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    static array $positions = [
        ['name' => 'It-специалист'],
        ['name' => 'Тимлид'],
        ['name' => 'HR']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$positions as $position) {
            Position::create($position);
        }
    }
}
