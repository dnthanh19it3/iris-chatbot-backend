<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any("chat", function (Request $request) {
    logger($request->all());
    return response()->json([
        "error" => 0,
        "data" => [
            "message" => "Phản hồi từ server từ tin nhắn: " . $request["message"]
        ],
        "details" => ""
    ]);
});
