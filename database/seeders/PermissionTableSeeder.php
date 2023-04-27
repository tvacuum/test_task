<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    static $rows = [
        ['role_id' => 1, 'module_id' => 1, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
        ['role_id' => 1, 'module_id' => 2, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
//        ['role_id' => 1, 'module_id' => 3, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
//        ['role_id' => 1, 'module_id' => 4, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
//        ['role_id' => 1, 'module_id' => 5, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
        ['role_id' => 2, 'module_id' => 1, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
        ['role_id' => 2, 'module_id' => 2, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
//        ['role_id' => 2, 'module_id' => 3, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
//        ['role_id' => 2, 'module_id' => 4, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0],
//        ['role_id' => 2, 'module_id' => 5, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0],
        ['role_id' => 3, 'module_id' => 1, 'c' => 1 , 'r' => 1, 'u' => 1, 'd' => 1],
        ['role_id' => 3, 'module_id' => 2, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0],
//        ['role_id' => 3, 'module_id' => 3, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0],
//        ['role_id' => 3, 'module_id' => 4, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0],
//        ['role_id' => 3, 'module_id' => 5, 'c' => 0 , 'r' => 0, 'u' => 0, 'd' => 0]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            Permission::create($row);
        }
    }
}
