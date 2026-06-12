<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'maba',
            'nim'      => '20260001',
            'email'    => 'maba@kampus.ac.id',
            'password' => Hash::make('password123'), // ← wajib pakai Hash::make()
        ]);
    }
}