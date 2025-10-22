<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;

class ControllerAuth extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // === 1. Cek di tabel USER ===
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            switch ($user->level) {
                case 'dosen':
                    return redirect('/dosen/dashboard');
                case 'pembimbing':
                    return redirect('/pembimbing/dashboard');
                case 'kaprodi':
                    return redirect('/kaprodi/dashboard');
                case 'mahasiswa':
                    return redirect('/mahasiswa/dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['email' => 'Level user tidak valid!']);
            }
        }

        // === 2. Jika tidak ada di tabel USER, cek di tabel MAHASISWA ===
        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
            // Buat sesi manual untuk mahasiswa
            session([
                'mahasiswa_logged_in' => true,
                'mahasiswa_id' => $mahasiswa->id_mahasiswa,
                'mahasiswa_nama' => $mahasiswa->nama,
                'mahasiswa_email' => $mahasiswa->email,
            ]);

            return redirect('/mahasiswa/dashboard');
        }

        // === 3. Jika keduanya gagal ===
        return back()->withErrors([
            'email' => 'Email atau password salah!'
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        // Logout dari Auth bawaan
        Auth::logout();

        // Hapus session mahasiswa jika ada
        $request->session()->forget([
            'mahasiswa_logged_in',
            'mahasiswa_id',
            'mahasiswa_nama',
            'mahasiswa_email',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
