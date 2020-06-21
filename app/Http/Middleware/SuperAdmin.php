<?php

namespace App\Http\Middleware;

use Closure;

use App\Helper\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
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
        if ($request->token->role !== 'SUPER_ADMIN') {
            return ResponseHandler::errorResponse(
                'Not allowed to access this privillege',
                Response::HTTP_UNAUTHORIZED
            );
        } 
        return $next($request);
    }
}
