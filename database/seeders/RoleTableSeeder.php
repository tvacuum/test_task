<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    static $roles = [
        ['name' => 'Админ'],
        ['name' => 'Менеджер'],
        ['name' => 'Сотрудник']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$roles as $role) {
            Role::create($role);
        }
    }
}
