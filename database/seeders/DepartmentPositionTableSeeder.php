<?php

namespace Database\Seeders;

use App\Models\DepartmentPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentPositionTableSeeder extends Seeder
{
static array $rows = [
        ['department_id' => 1, 'position_id' => 1],
        ['department_id' => 1, 'position_id' => 2],
        ['department_id' => 1, 'position_id' => 3],
        ['department_id' => 2, 'position_id' => 1],
        ['department_id' => 2, 'position_id' => 2],
        ['department_id' => 3, 'position_id' => 1],
        ['department_id' => 3, 'position_id' => 3]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            DepartmentPosition::create($row);
        }
    }
}
