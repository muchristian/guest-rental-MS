<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;

trait ErrorHandler 
{
    public function errorResponse($request, $e) {
        if ($e instanceof NotFoundHttpException) {
            return ResponseHandler::errorResponse(
                'A written route not found',
                 Response::HTTP_NOT_FOUND
                );
        }
        if ($e instanceof ModelNotFoundException) {
            return ResponseHandler::errorResponse(
                'Model not found', 
                Response::HTTP_NOT_FOUND
            );
        }
        if ($e instanceof AuthenticationException) {
            return ResponseHandler::errorResponse(
                'Unauthenticated',
                Response::HTTP_UNAUTHORIZED
            );
        }

        return parent::render($request, $e);
    }
    
}