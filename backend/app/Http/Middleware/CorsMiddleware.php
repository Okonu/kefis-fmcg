<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle($request, \Closure $next)
    {
        $allowedOrigins = ['http://your-frontend-app-domain:your-frontend-port'];
        $requestOrigin = $request->headers->get('origin');

        if (in_array($requestOrigin, $allowedOrigins)) {
            $headers = [
                'Access-Control-Allow-Origin' => $requestOrigin,
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                'Access-Control-Allow-Credentials' => 'true',
            ];

            if ($request->getMethod() === 'OPTIONS') {
                return new Response(null, 200, $headers);
            }

            $response = $next($request);

            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }

            return $response;
        }

        return response()->json(['message' => 'Not allowed.'], 403);
    }
}
