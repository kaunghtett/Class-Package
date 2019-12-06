<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Response;

trait ResponserTrait {

    public function respondCollection($message, $data) {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
            'data' => $data,
        ], 201);
    }

    public function respondLists($data) {
        return response()->json([
            'errorCode' => 0,
            'message' => 'Success',
            'data' => $data
        ], 200);
    }
    
    protected function respondPermissionDenied() {
        return response()->json([
            'code' => 403,
            'message' => 'Permission denied',
        ], 200);
    }

    protected function exceptionResponse($msg, $code,$responseCode = 200) {
        $result = [
            'code' => $code,
            'message' => $msg,
        ];

        return response()->json($result, $responseCode);
    }



    protected function errorResponse($msg) {
        $result = [
            'code' => 426,
            'message' => $msg,
        ];

        return response()->json($result, 200);
    }


    public function respondSuccessMsgOnly($message) {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $message,
        ], 200);
    }
  
   
    public function respondErrorToken($message)
    {
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => $message,
        ], 400);
    }
    public function respondErrorTokenExpire($message)
    {
        return response()->json([
            'code' => Response::HTTP_NOT_ACCEPTABLE,
            'message' => $message,
        ], Response::HTTP_NOT_ACCEPTABLE);
    }

}
