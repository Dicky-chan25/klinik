<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SiteHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path(). '/Helpers/SiteHelpers.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
