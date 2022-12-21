<?php

use App\Http\Controllers\Api\AiRequestController;
use App\Http\Controllers\Api\SocialNetwork\FacebookApiController;
use App\Ultils\FacebookUltils;
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

Route::controller(AiRequestController::class)->prefix("ai")->group(function () {
    Route::post("predict", "predictAi")->name("api.ai.predict");
});

Route::prefix("social")->group(function () {
    Route::prefix("facebook")->controller(FacebookApiController::class)->group(function () {
        Route::any("hook", "hook");
        Route::post("login_callback", "loginCallback")->name("api.social.login_callback");
        Route::post("page_verify", "pageVerify")->name("api.social.page_verify");
        Route::any("callback", "callback");
    });
});
Route::get("test", [FacebookApiController::class, "test"]);
