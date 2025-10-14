<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ControllerAuth extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses loginweb
    
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required']
    ]);

    // Ambil user berdasarkan email
    $user = User::where('email', $request->email)->first();

    if ($user && \Hash::check($request->password, $user->password)) {
        // Login user
        Auth::login($user);

        $request->session()->regenerate();

        // Redirect berdasarkan level
        switch($user->level) {
            case 'dosen':
                return redirect('/dosen/dashboard');
            case 'pembimbing':
                return redirect('/pembimbing/dashboard');
            case 'keprodi':
                return redirect('/keprodi/dashboard');
            default:
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Level user tidak valid!'
                ]);
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah!'
    ]);
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
