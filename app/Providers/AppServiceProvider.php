<?php

namespace App\Providers;

use App\Models\School_profiles;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        View::composer('landing.*', function ($view) {
            $view->with('profile', School_profiles::first());
        });

        View::composer('Admin.*', function ($view) {
            $view->with('profile', School_profiles::first());
        });
    }
}
