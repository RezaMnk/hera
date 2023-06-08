<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFour();

        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Blade::directive('owner', function ($expression) {
            return "<?php if (auth()->user()->is_owner()): ?>";
        });

        Blade::directive('endowner', function ($expression) {
            return "<?php endif; ?>";
        });

        Blade::directive('admin', function ($expression) {
            return "<?php if (auth()->user()->is_admin()): ?>";
        });

        Blade::directive('endadmin', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
