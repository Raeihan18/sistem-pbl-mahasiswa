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
                'no_wa' => '6285787064089',
                'level' => 'dosen'
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@politala.ac.id',
                'password' => Hash::make('password123'),
                'no_wa' => '6285787064089',
                'level' => 'pembimbing'
            ],
            [
                'nama' => 'Dewi Kartika',
                'email' => 'dewi.kartika@politala.ac.id',
                'password' => Hash::make('password123'),
                'no_wa' => '6285787064089',
                'level' => 'kaprodi'
            ],

             [
                'nama' => 'Andhika',
                'email' => 'andhika@politala.ac.id',
                'password' => Hash::make('password123'),
                'no_wa' => '6285787064089',
                'level' => 'admin'
            ],


        ]);
    }
}