<?php

use App\Http\Controllers\Web\User\ProjectController;
use App\Http\Controllers\Web\User\UserAuthController;
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



//Route::get('/', function () {
//    return view('admin.layouts.layout');
//})->name("dashboard");


Route::get("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "loginUI"])->name("user.login");
Route::post("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "authenticate"])->name("user.login.post");
Route::get("test", function (){
   $user = \Illuminate\Support\Facades\Auth::user();
   session()->regenerate(true);
   dd($user, $user->projects()->select("id", "name")->get());
})->middleware("auth.user");

//Chat
Route::view("csr/{any}", "app")->where("any", ".*");
Route::view("csr", "app");

Route::middleware(["auth.user"])->group(function (){
    Route::prefix("console")->group(function (){
        Route::get("/", function (){
            return view('admin.layouts.layout');
        })->name("console.dashboard");
        Route::prefix("project")->controller(ProjectController::class)->group(function (){
            Route::get("/", "index")->name("user.project.index");
        });
    });
    Route::get("/", function (){
       return redirect()->route("console.dashboard");
    });
});


Route::group(["middleware" => ["guest"]], function (){
    Route::get("login", [UserAuthController::class, "loginUI"])->name("user.auth.login");
    Route::post("login", [UserAuthController::class, "authenticate"])->name("user.auth.login.post");
});


