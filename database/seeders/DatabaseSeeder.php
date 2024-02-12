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

        User::create([
            'name' => 'Devina Urohmani',
            'email' => "devina@gmail.com",
            'password' => bcrypt('admin123'),
            'level' => 'admin',
        ]);
    }
}