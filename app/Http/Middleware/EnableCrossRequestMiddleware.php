<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnableCrossRequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allow_origin = [
            'http://your-domain:port',
        ];
        if (in_array($origin, $allow_origin)) {
            $response->headers->add(['Access-Control-Allow-Origin' => $origin]);
            $response->headers->add(['Access-Control-Allow-Headers' => 'Origin, Content-Type, Cookie,X-CSRF-TOKEN, Accept,Authorization']);
            $response->headers->add(['Access-Control-Expose-Headers' => 'Authorization,authenticated']);
            $response->headers->add(['Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, OPTIONS']);
            $response->headers->add(['Access-Control-Allow-Credentials' => 'true']);
        }
        return $response;
    }
}
