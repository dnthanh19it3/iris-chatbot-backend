<?php

use App\Http\Controllers\Web\UserControllers\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Login route
Route::get("login", [UserAuthController::class, "loginUI"]);

Route::get('/', function () {
    return view('admin.layouts.layout');
});
Route::get("/login", [\App\Http\Controllers\Web\UserControllers\UserAuthController::class, "loginUI"])->name("user.login");
Route::post("/login", [\App\Http\Controllers\Web\UserControllers\UserAuthController::class, "authenticate"])->name("user.login");
