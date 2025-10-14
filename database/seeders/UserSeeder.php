<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            [
                'nama' => 'Dr. Ahmad Khaidir',
                'email' => 'ahmad.khaidir@politala.ac.id',
                'password' => Hash::make('password123'),
                'level' => 'dosen'
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@politala.ac.id',
                'password' => Hash::make('password123'),
                'level' => 'pembimbing'
            ],
            [
                'nama' => 'Dewi Kartika',
                'email' => 'dewi.kartika@politala.ac.id',
                'password' => Hash::make('password123'),
                'level' => 'keprodi'
            ]
        ]);
    }
}
