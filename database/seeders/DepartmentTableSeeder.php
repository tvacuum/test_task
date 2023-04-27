<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    static $departments = [
        ['name' => 'It-отдел',        'color' => '#34eba8'],
        ['name' => 'Кол-центр',       'color' => '#34c9eb'],
        ['name' => 'Дропшиппинг',     'color' => '#348feb'],
        ['name' => 'Оптовый',         'color' => '#343deb'],
        ['name' => 'Фотографы',       'color' => '#6e34eb'],
        ['name' => 'Бухгалтерия',     'color' => '#9334eb'],
        ['name' => 'Снабжение',       'color' => '#b734eb'],
        ['name' => 'Маркетинговый',   'color' => '#e534eb'],
        ['name' => 'Wildberries',     'color' => '#eb3483'],
        ['name' => 'Обмены/Возвраты', 'color' => '#eb3483'],
        ['name' => 'Склад',           'color' => '#eb3483']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$departments as $department) {
            Department::create($department);
        }
    }
}
