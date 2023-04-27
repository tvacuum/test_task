<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    static $rows = [
        ['user_id' => 1, 'role_id' => 1],
        ['user_id' => 2, 'role_id' => 2],
        ['user_id' => 3, 'role_id' => 3]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            UserRole::create($row);
        }
    }
}
