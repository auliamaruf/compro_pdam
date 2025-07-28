<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Security Headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        
        // Content Security Policy - Balanced security with functionality
        $isProduction = app()->environment('production');
        
        if ($isProduction) {
            // Strict CSP for production
            $csp = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://www.google.com https://maps.googleapis.com",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
                "font-src 'self' https://fonts.gstatic.com",
                "img-src 'self' data: https: blob:",
                "connect-src 'self' https://www.google.com https://maps.googleapis.com",
                "media-src 'self'",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-src https://www.google.com https://maps.google.com",
                "frame-ancestors 'none'",
                "upgrade-insecure-requests"
            ];
        } else {
            // Development-friendly CSP with good security
            $csp = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://www.google.com https://maps.googleapis.com http://localhost:5173 http://localhost:5174 http://127.0.0.1:5173 http://127.0.0.1:5174 http://[::1]:5173 http://[::1]:5174 ws://localhost:5173 ws://localhost:5174 ws://127.0.0.1:5173 ws://127.0.0.1:5174 ws://[::1]:5173 ws://[::1]:5174",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com http://localhost:5173 http://localhost:5174 http://127.0.0.1:5173 http://127.0.0.1:5174 http://[::1]:5173 http://[::1]:5174",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com",
                "img-src 'self' data: https: http: blob:",
                "connect-src 'self' https://www.google.com https://maps.googleapis.com http://localhost:5173 http://localhost:5174 http://127.0.0.1:5173 http://127.0.0.1:5174 http://[::1]:5173 http://[::1]:5174 ws://localhost:5173 ws://localhost:5174 ws://127.0.0.1:5173 ws://127.0.0.1:5174 ws://[::1]:5173 ws://[::1]:5174",
                "media-src 'self'",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "frame-src 'self' https://www.google.com https://maps.google.com",
                "frame-ancestors 'none'"
            ];
        }
        
        $cspString = implode('; ', $csp);
        $response->headers->set('Content-Security-Policy', $cspString);

        return $response;
    }
}
