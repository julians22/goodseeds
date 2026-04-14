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
     * @param Closure(Request):Response $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Strict-Transport-Security
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

         // Content-Security-Policy
        $csp = implode(' ', [
            "default-src 'self';",
            "script-src 'self' https://www.googletagmanager.com https://www.google.com/recaptcha/ https://www.gstatic.com 'unsafe-inline';",
            "style-src 'self' https://fonts.googleapis.com https://fonts.bunny.net 'unsafe-inline';",
            "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net;",
            "img-src 'self' data:;",
            "frame-src https://www.google.com/recaptcha/;",
            "connect-src 'self' https://www.google-analytics.com;",
        ]);

        if (config('app.env') === 'production') {
            $csp .= " upgrade-insecure-requests;";
            $response->headers->set('Content-Security-Policy', $csp);
        }



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
