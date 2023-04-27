<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    static array $modules = [
        ['name' => 'Главная',        'URI' => '/'],
        ['name' => 'Личный кабинет', 'URI' => '/cabinet'],
//        ['name' => 'Канцелярия',     'URI' => '/chancellery'],
//        ['name' => 'Админ панель',   'URI' => '/admin'],
//        ['name' => 'Бухгалтерия',    'URI' => '/accounting']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$modules as $module) {
            Module::create($module);
        }
    }
}
