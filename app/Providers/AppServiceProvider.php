<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        //
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        };
        if ($this->app->environment('local')) {
            \URL::forceScheme('http');
        };
        Blade::directive('ifUsa_ldap', function () {
            return "<?php if (config('cian.utilizaldap')===true): ?>";
        });
        Blade::directive('ifNaoUsa_ldap', function () {
            return "<?php if (config('cian.utilizaldap')===false): ?>";
        });
    }
}
