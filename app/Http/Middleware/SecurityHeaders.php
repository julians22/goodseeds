<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Strict-Transport-Security
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // Content-Security-Policy
        $csp = implode(' ', [
            "default-src 'self';",
            "script-src 'self' https://www.googletagmanager.com https://www.google.com/recaptcha/ 'unsafe-inline';",
            "style-src 'self' https://fonts.googleapis.com 'unsafe-inline';",
            "font-src 'self' https://fonts.gstatic.com;",
            "img-src 'self' data:;",
            "frame-src https://www.google.com/recaptcha/;"
        ]);

        $response->headers->set('Content-Security-Policy', $csp);


        // X-Frame-Options
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // X-Content-Type-Options
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer-Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions-Policy
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');

        return $response;
    }
}
