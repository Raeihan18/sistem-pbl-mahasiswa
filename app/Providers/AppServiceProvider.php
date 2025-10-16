<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
    View::composer('layout.layout-admin', function ($view) {
        $authUser = auth()->user();
        $profil = null;

        if ($authUser) {
            $profil = Profil::where('id_user', $authUser->id_user)->first();
        }

        $view->with([
            'authUser' => $authUser,
            'profil' => $profil,
        ]);
    });
}
}
