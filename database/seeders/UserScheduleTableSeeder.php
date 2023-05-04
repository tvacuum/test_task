<?php

namespace Database\Seeders;

use App\Models\UserSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserScheduleTableSeeder extends Seeder
{
    static array $rows = [
        ['user_id' => 1, 'schedule_id' => 1],
        ['user_id' => 2, 'schedule_id' => 2],
        ['user_id' => 3, 'schedule_id' => 3]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            UserSchedule::create($row);
        }
    }
}
