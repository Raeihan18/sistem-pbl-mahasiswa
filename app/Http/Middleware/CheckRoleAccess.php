<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleAccess
{
    // prefix path untuk masing-masing role
    private $rolePaths = [
        'admin'       => 'admin',
        'dosen'       => 'dosen',
        'pembimbing'  => 'pembimbing',
        'kaprodi'     => 'kaprodi',
        'mahasiswa'   => 'mahasiswa',
    ];

    public function handle(Request $request, Closure $next)
    {
        $guard = null;
        $role  = null;

        // Jika login sebagai staff/dosen/admin (tabel users)
        if (Auth::guard('web')->check()) {
            $guard = 'web';
            $role  = strtolower(Auth::guard('web')->user()->level);
        }

        // Jika login sebagai mahasiswa (tabel mahasiswa)
        elseif (Auth::guard('mahasiswa')->check()) {
            $guard = 'mahasiswa';
            $role  = 'mahasiswa';   // fix role mahasiswa
        }

        // Jika tidak login sama sekali
        else {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi role ada
        if (!isset($this->rolePaths[$role])) {
            return abort(403, 'Anda Tidak Memiliki Akses Role Ini');
        }

        $prefixRequired = $this->rolePaths[$role];
        $currentPath    = $request->path(); // contoh: admin/dashboard

        // Cegah akses path yang tidak sesuai role
        if (!str_starts_with($currentPath, $prefixRequired)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
