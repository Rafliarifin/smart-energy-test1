<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama_lengkap' => 'Admin SmartEnergy',
            'email' => 'admin@smartenergy.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // Tambahkan role admin
        ]);
    }
}
