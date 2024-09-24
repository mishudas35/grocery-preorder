<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        $response = $next($request);
//
//        $response->headers->set('Access-Control-Allow-Origin', '*');
//        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
//        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
//
//        if ($request->getMethod() === "OPTIONS") {
//            // Preflight request response
//            $response->headers->set('Access-Control-Max-Age', '1728000');
//            $response->setStatusCode(200);
//        }
//
//        return $response;
//    }
    public function handle($request, Closure $next)
    {
        $allowedOrigins = ['http://localhost:8080']; // List of allowed origins

        $origin = $request->headers->get('Origin');

        $response = $next($request);

        // Only allow the origin if it's in the list of allowed origins
        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        }

        // Set necessary CORS headers
        $response->headers->set('Access-Control-Allow-Credentials', 'true'); // Allow credentials
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Handle preflight request (OPTIONS)
        if ($request->getMethod() === "OPTIONS") {
            $response->headers->set('Access-Control-Max-Age', '1728000');
            $response->setStatusCode(200);
        }

        return $response;
    }
}
