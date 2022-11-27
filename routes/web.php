<?php

use App\Http\Controllers\Web\User\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\User\ProjectController;

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
Route::get("login", [UserAuthController::class, "loginUI"])->name("user.auth.login");
Route::post("login", [UserAuthController::class, "authenticate"])->name("user.auth.login");

Route::prefix("console")->group(function (){
    Route::prefix("project")->controller(ProjectController::class)->group(function (){
       Route::get("/", "index")->name("user.project.index");
    });
});
Route::get('/', function () {
    return view('admin.layouts.layout');
})->name("dashboard");


Route::get("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "loginUI"])->name("user.login");
Route::post("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "authenticate"])->name("user.login.post");
Route::get("test", function (){
   $user = \Illuminate\Support\Facades\Auth::user();
   ddd($user, $user->projects()->select("id", "name")->get());
});

//Chat
Route::view("csr/{any}", "app")->where("any", ".*");
Route::view("csr", "app");
