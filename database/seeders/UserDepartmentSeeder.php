<?php

namespace Database\Seeders;

use App\Models\UserDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDepartmentSeeder extends Seeder
{
    static $rows = [
        ['user_id' => 1, 'department_id' => 1],
        ['user_id' => 2, 'department_id' => 2],
        ['user_id' => 3, 'department_id' => 3]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            UserDepartment::create($row);
        }
    }
}
