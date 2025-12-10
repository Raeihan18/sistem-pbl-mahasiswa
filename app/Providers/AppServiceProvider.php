<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Mahasiswa;
use App\Models\Profil;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    View::composer(['layout.layout-admin', 'layout.layout-dosen', 'layout.layout-kaprodi', 'layout.layout-mahasiswa', 'layout.layout-pembimbing'], function ($view) {
        $authUser = auth()->user();
        $profil = null;
        $mahasiswa = null;

        if ($authUser) {
            // Jika login dari tabel users
            $profil = \App\Models\Profil::where('id_user', $authUser->id_user)->first();
        } elseif (session()->has('mahasiswa_logged_in')) {
            // Jika login dari tabel mahasiswa (sesi manual)
            $mahasiswaId = session('mahasiswa_id');
            $mahasiswa = \App\Models\Mahasiswa::find($mahasiswaId);
        }

        $view->with([
            'authUser' => $authUser,
            'profil' => $profil,
            'mahasiswa' => $mahasiswa,
        ]);
    });
}

}
