<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    static $services = [
        ['name' => 'Журнал', 'URL' => 'http://localhost/'],
//        ['name' => 'Админ панель', 'URL' => 'http://localhost/'],
//        ['name' => 'Бухгалтерия', 'URL' => 'http://localhost/']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$services as $service) {
            Service::create($service);
        }
    }
}
