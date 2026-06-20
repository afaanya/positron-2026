<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [
            [
                'name'     => 'maba',
                'nim'      => '20260001',
                'email'    => 'maba@students.um.ac.id',
                'password' => Hash::make('mabadtei2026'), // ← wajib pakai Hash::make()
            ],
            [
                'name'     => 'Muhammad Alif Raufan',
                'nim'      => '250535622896',
                'email'    => 'muhammad.alif.2505356@students.um.ac.id',
                'password' => Hash::make('mabadtei2026'),
            ]
        ];

        foreach ($mahasiswa as $data) {
            \App\Models\User::updateOrCreate(
                ['nim' => $data['nim']], // Cek berdasarkan NIM
                $data // update/insert data
            );
        }
    }
}