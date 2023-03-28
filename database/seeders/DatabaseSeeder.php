<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\category;
use App\Models\expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Quốc Thái',
             'email' => 'quocthai0099@gmail.com',
             'password' => bcrypt('quocthai123')
         ]);
         \App\Models\User::factory(10)->create();

         category::factory(10)->create();
         expense::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
