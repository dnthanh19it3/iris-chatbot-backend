<?php

use App\Http\Controllers\Api\AiRequestController;
use App\Http\Controllers\Api\SocialNetwork\FacebookApiController;
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

Route::controller(AiRequestController::class)->prefix("ai")->group(function (){
    Route::post("predict","predictAi")->name("api.ai.predict");
});

Route::prefix("social")->group(function (){
    Route::controller(FacebookApiController::class)->group(function (){
        Route::post("hook", "hook");
   });
});
