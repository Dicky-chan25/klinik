<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Gate::define('superadmin', function( User $user) {
            return $user->role_id === 1 ;
        });
        Gate::define('admin', function( User $user) {
            return $user->role_id === 2 ;
        });
        Gate::define('apotek', function( User $user) {
            return $user->role_id === 3 ;
        });

        
    }
}
