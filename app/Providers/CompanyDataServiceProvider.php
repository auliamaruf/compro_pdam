<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\CompanySetting;
use App\Models\NavigationMenu;

class CompanyDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register company data service
        $this->app->singleton('company', function ($app) {
            // Get active company setting from cache or database
            return Cache::rememberForever('company_setting_current', function () {
                return CompanySetting::current();
            });
        });
        
        // Register navigation menu service
        $this->app->singleton('mainNavigation', function ($app) {
            return Cache::rememberForever('navigation_main_menu', function () {
                return NavigationMenu::with('children')
                    ->active()
                    ->mainMenu()
                    ->orderBy('sort_order')
                    ->get();
            });
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share company data globally to all views
        View::composer('*', function ($view) {
            $company = app('company');
            $mainNavigation = app('mainNavigation');
            
            $view->with('company', $company);
            $view->with('mainNavigation', $mainNavigation);
        });
    }
}
