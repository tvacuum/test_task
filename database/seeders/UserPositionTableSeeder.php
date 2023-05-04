<?php

namespace Database\Seeders;

use App\Models\UserPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPositionTableSeeder extends Seeder
{
    static array $rows = [
        ['user_id' => 1, 'position_id' => 1],
        ['user_id' => 2, 'position_id' => 2],
        ['user_id' => 3, 'position_id' => 3]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            UserPosition::create($row);
        }
    }
}
