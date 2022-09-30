<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($message, $status, $data = [] )
    {
        $response = [
            'message' => $message,
            'status' => $status,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $status, $errMessage = [])
    {
        $response = [
            'message' => $error,
            'status' => $status
        ];

        if (!empty($errMessage)) {
            $response['data'] = $errMessage;
        }

        return response()->json($response, $status);
    }

    public function sendSuccessAuth($message, $status, $token, $data = [])
    {
        $response = [
            'message' => $message,
            'status' => $status,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $data,
        ];

        return response()->json($response, 200);
    }

}
