<?php

namespace App\V1\Traits\Response;

trait MessageTrait
{
    protected function messageResponse(string $message , int $status): string
    {
        return response()->json([
            'message' => $message
        ] , $status);
    }

    protected function successResponse(string $message = 'The operation was successful.'): string
    {
        return response()->json([
            'message' => $message
        ]);
    }

    protected function failedResponse(int $status): string
    {
        return response()->json([
            'message' => 'The operation encountered an error.'
        ] , $status);
    }

    protected function unprocessableResponse(array $errors): string
    {
        $newErrors = [];
        foreach ($errors as $error){
            $newErrors[] = [
                'title' => "Field {$error['field']['locale']} is invalid." ,
                'message' => $error['message'] ,
                'field' => $error['field']['nonLocale']
            ];
        }
        return response()->json([
            'message' => 'The information submitted is invalid.' ,
            'errors' => $newErrors
        ] , 422);
    }

    protected function notFoundResponse(string $message = 'The requested service was not found.'): string
    {
        return response()->json([
            'message' => $message
        ] , 404);
    }

    protected function forbiddenResponse(string $message = 'You do not have permission to access this service.'): string
    {
        return response()->json([
            'message' => $message
        ] , 403);
    }

    protected function createdResponse(string $message = 'Information was successfully recorded.'): string
    {
        return response()->json([
            'message' => $message
        ] , 201);
    }

    protected function notAcceptableResponse(string $header): string
    {
        return response()->json([
            'message' => "$header header is invalid" ,
        ] , 406);
    }
}