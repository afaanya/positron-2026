<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // database/seeders/DatabaseSeeder.php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

        User::create([
            'name'     => 'maba',
            'nim'      => '20260001',
            'email'    => 'maba@um.ac.id',
            'password' => Hash::make('mabadtei2026'),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
