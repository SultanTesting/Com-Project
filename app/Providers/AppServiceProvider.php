<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\GeneralSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
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
        $generalSet = GeneralSettings::first();
        $categories_view = Category::where('status', 'Active')->get();

        /** Share to all view blades */
        View::share([
            'categories_view' => $categories_view,
            'settings' => $generalSet
        ]);

        /** Set TimeZone */
        Config::set('app.timezone', $generalSet->timezone);
    }
}
