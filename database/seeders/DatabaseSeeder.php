<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        $this->call(WorkplaceTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(UserDepartmentSeeder::class);
        $this->call(ServiceModuleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
