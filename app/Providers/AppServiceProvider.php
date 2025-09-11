<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\View\Composers\NavbarComposer;
use App\Observers\MediaObserver;
use App\Support\DeploymentHelper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        // Configure URLs for deployment
        DeploymentHelper::configureUrls();
        
        // Share navbar data with layout views
        View::composer(['layouts.app', 'components.navbar'], NavbarComposer::class);
        
        // Register Media Observer for Activity Log
        Media::observe(MediaObserver::class);
    }
}
