<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;

class verifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         
        if ($request->token->is_verified !== 1) {
            return ResponseHandler::errorResponse(
                'check if you have verified your account',
                Response::HTTP_UNAUTHORIZED
            );
        }
        return $next($request);
    }
}
