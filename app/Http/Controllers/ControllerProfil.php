<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ControllerProfil extends Controller
{
     public function index()
    {
            // Data dummy, nanti bisa diambil dari session/auth
            $profil = [
                'nama' => 'Dr. Ahmad Khaidir',
                'nidn' => '1234567890',
                'email' => 'ahmad.khaidir@universitas.ac.id',
                'matkul' => ['Pemrograman Web', 'Basis Data', 'PBO'],
                'foto' => 'default-avatar.png' // letakkan di public/images/
            ];

        return view('profil.index', compact('profil'));
    }
}
