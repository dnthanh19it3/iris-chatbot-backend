<?php

use App\Http\Controllers\Web\User\ProjectController;
use App\Http\Controllers\Web\User\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AI\IntentController;

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


//Route::get("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "loginUI"])->name("user.login");
//Route::post("/login", [\App\Http\Controllers\Web\User\UserAuthController::class, "authenticate"])->name("user.login.post");
Route::get("logout", function (){
   $user = \Illuminate\Support\Facades\Auth::user();
   session()->regenerate(true);
   return redirect()->route("user.auth.login");
//   dd($user, $user->projects()->select("id", "name")->get());
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
            Route::get("create", "create")->name("user.project.create");
            Route::post("create", "createPost")->name("user.project.create.post");
            Route::get("update/{id}", "update")->name("user.project.update");
            Route::post("update", "updatePost")->name("user.project.update.post");
        });
        Route::prefix("ai")->group(function (){
            Route::prefix("intent")->controller(IntentController::class)->group(function (){
                Route::get("/", "index")->name("ai.intent.index");
                Route::get("/edit/{id}", "edit")->name("ai.intent.edit");
                Route::post("/edit/{id}", "editPost")->name("ai.intent.edit-post");
            });
        });
    });

});

Route::get("/", function (){
    return view("index");
});

Route::group(["middleware" => ["guest"]], function (){
    Route::get("login", [UserAuthController::class, "loginUI"])->name("user.auth.login");
    Route::post("login", [UserAuthController::class, "authenticate"])->name("user.auth.login.post");
});
