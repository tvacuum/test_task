<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TimeReport;
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
        TimeReport::factory(90)->create();
        $this->call(DepartmentTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(UserPositionTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(DepartmentPositionTableSeeder::class);
        $this->call(UserScheduleTableSeeder::class);
        $this->call(ServiceModuleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
