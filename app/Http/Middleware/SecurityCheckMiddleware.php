<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SecurityService;
use Illuminate\Support\Facades\Log;

class SecurityCheckMiddleware
{
    protected $security;

    public function __construct(SecurityService $security)
    {
        $this->security = $security;
    }

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        
        // Check if IP is blocked
        if ($this->security->isIpBlocked($ip)) {
            Log::warning('Blocked IP attempted access', [
                'ip' => $ip,
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()
            ]);

            // Return 429 Too Many Requests
            abort(429, 'Too Many Requests. Your IP has been temporarily blocked due to suspicious activity.');
        }

        return $next($request);
    }
}