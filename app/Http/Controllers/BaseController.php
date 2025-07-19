<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function successResponse($message, $status = 200)
    {
        $payload = [
            'status' => 'success',
            'data' => $message
        ];

        return new JsonResponse($payload, $status);
    }

    public function exceptionResponse(\Exception $exception)
    {
        $payload = [
            'status' => 'error',
            'message' => $exception->getMessage()
        ];
        
        $code = $exception->getCode();
        if($code == 0 || $code > 20000){
            $code = 500;
        }

        return new JsonResponse($payload, $code);
    }    
}
