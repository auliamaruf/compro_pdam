<?php

namespace App\Support;

class DeploymentHelper
{
    /**
     * Force HTTPS URLs in production if needed
     */
    public static function configureUrls()
    {
        if (app()->environment('production')) {
            // Force HTTPS in production if behind load balancer/proxy
            if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
                \URL::forceScheme('https');
            }
            
            // Force root URL if APP_URL is set
            if ($appUrl = config('app.url')) {
                \URL::forceRootUrl($appUrl);
            }
        }
    }
    
    /**
     * Get safe asset URL based on environment
     */
    public static function assetUrl($path)
    {
        if (app()->environment('production')) {
            return asset($path);
        }
        
        // In development, use Vite if available
        return asset($path);
    }
    
    /**
     * Check if we should use Vite dev server
     */
    public static function shouldUseViteDevServer()
    {
        return app()->environment('local') && 
               file_exists(public_path('hot'));
    }
}
