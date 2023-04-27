<?php

namespace Database\Seeders;

use App\Models\ServiceModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceModuleTableSeeder extends Seeder
{
    static $rows = [
        ['service_id' => 1, 'module_id' => 1],
        ['service_id' => 1, 'module_id' => 2],
//        ['service_id' => 1, 'module_id' => 3],
//        ['service_id' => 2, 'module_id' => 4],
//        ['service_id' => 3, 'module_id' => 5]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            ServiceModule::create($row);
        }
    }
}
