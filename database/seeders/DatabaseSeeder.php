<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'fullname' => 'Balqis Rosa',
            'email' => 'balqisrosasekamayang@gmail.com',
            'password' => Hash::make('admin12345'),
            'gambar' => '240107121410.jpg',
            'role' => 'admin'
        ]);
    }
}
