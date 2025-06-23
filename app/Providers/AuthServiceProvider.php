<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('solo-paciente', fn($user) => $user->role === 'paciente');

        Gate::define('solo-profesional', fn($user) => $user->role === 'profesional');

        Gate::define('solo-proveedor', fn($user) => $user->role === 'proveedor');

        Gate::define('solo-admin', fn($user) => $user->role === 'admin');
    }
}
