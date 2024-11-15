<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'member',
            'email' => 'member@gmail.com'
        ]);

        User::factory()->create([
            'name' => 'member2',
            'email' => 'member2@gmail.com'
        ]);

        User::factory()->create([
            'name' => 'instructor',
            'email' => 'instructor@gmail.com',
            'role' => 'instructor'
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);



        User::factory()->count(10)->create();

        User::factory()->count(10)->create([
            'role' => 'instructor'
        ]);

    }
}
