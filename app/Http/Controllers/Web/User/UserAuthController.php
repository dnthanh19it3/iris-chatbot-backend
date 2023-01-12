<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    public function loginUI(){
        return view("admin.pages.auths.login");
    }
    public function authenticate(LoginRequest $request)
    {
//        dd($request->all());
        DB::enableQueryLog();

        $credentials = $request->validated();

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $projects = Auth::user()->projects()->select("id", "name")->get();
            try {
                //Set user information session
                session([
                    "auth" => [
                        "role" => "user",
                        "info" => [
                            "email" => $user->email ?? "",
                            "name" => $user->name ?? "",
                            "username" => $user->username ?? "",
                            "avatar" => $user->avatar ? asset($user->avatar) : asset("assets/images/avatar/sample-user-avatar.jpg")
                        ]
                    ],
                    "project" => [
                        "list" => $projects,
                        "selected" => (count($projects) > 0) ? $projects->shift() : null
                    ]
                ]);
            } catch (\Throwable $e){
                $request->session()->regenerate();
                return back(500)->withErrors(["invalid-auth" => trans("app.web.internal-error")])->onlyInput('email');
            }
            //Handle success
            return redirect()->route("console.dashboard");
        }
        //Handle failed
        return back()->withErrors(["invalid-auth" => trans("auth.web.auth.invalid-cred")])->onlyInput('email');
    }

    public function register(){
        return view("admin.pages.auths.register");
    }

    public function registerPost(){

    }
}
