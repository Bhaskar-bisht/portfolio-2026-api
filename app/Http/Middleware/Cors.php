<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    public function handle(Request $request, Closure $next): Response
    {
        // Allowed origins ki list
        $allowedOrigins = [
            env('FRONTEND_URL_PRODUCTION'),
            env('FRONTEND_URL_LOCAL')
        ];


        $origin = $request->headers->get('Origin');

        $response = $next($request);

        // Check karo ki request allowed origins mein se hai ya nahi
        if (in_array($origin, $allowedOrigins)) {
            $response->header('Access-Control-Allow-Origin', $origin);
        }

        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
        $response->header('Access-Control-Allow-Credentials', 'true');

        // OPTIONS request ko handle karo (preflight)
        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(200);
        }

        return $response;
    }
}
