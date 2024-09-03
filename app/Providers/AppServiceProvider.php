<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function($user, $permiso){
            // if()
            // print_r($user->permisos)
            if($user->permisos()->contains('manage_all')){
                return true;
            }
            return $user->permisos()->contains($permiso);
        });
    }
}
