<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function responseError($errors = [], $statusCode = Response::HTTP_BAD_REQUEST, $msg = 'Failed')
    {
        $data = [
            'error' => true,
            'message' => $msg,
            'data' => $errors,
        ];
        return response()->json( $data, $statusCode);
    }

    public function responseSuccess($data = '', $statusCode = Response::HTTP_OK, $msg = 'Successful')
    {
        $data = [
            'error' => false,
            'message' => $msg,
            'data' => $data,
        ];
        return response()->json( $data, $statusCode);
    }

}
