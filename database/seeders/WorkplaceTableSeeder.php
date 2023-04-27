<?php

namespace Database\Seeders;

use App\Models\Workplace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkplaceTableSeeder extends Seeder
{
    static $rows = [
        ['name' => 'Офис'],
        ['name' => 'Дом']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$rows as $row) {
            Workplace::create($row);
        }
    }
}
