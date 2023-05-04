<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    static array $schedules = [
        ['time' => '8:00:00'],
        ['time' => '9:00:00'],
        ['time' => '10:00:00']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
