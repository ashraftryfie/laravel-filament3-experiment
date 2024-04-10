<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Ashraf',
             'email' => 'admin@admin.com',
             'password' => bcrypt('123'),
             'role' => UserRole::ADMIN,
         ]);

        User::factory()->create([
            'name' => 'Ashraf',
            'email' => 'admin@editor.com',
            'password' => bcrypt('123'),
            'role' => UserRole::Editor,
        ]);

        User::factory()->create([
            'name' => 'Ashraf',
            'email' => 'admin@user.com',
            'password' => bcrypt('123'),
            'role' => UserRole::USER,
        ]);
    }
}
