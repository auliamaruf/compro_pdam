<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Security middleware with improved CSP for logo and maps
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeadersMiddleware::class,
            \App\Http\Middleware\SecurityCheckMiddleware::class,
        ]);
        
        // Rate limiting for specific routes
        $middleware->throttleApi();
        
        // Additional security middleware
        $middleware->encryptCookies();
        
        // Register security middleware alias
        $middleware->alias([
            'security.check' => \App\Http\Middleware\SecurityCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
