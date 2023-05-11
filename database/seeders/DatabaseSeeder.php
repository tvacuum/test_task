<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\CategoryBook;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Author::factory(3)->create();
        Category::factory(5)->create();
        Book::factory(20)->create();
        CategoryBook::factory(20)->create();
    }
}
