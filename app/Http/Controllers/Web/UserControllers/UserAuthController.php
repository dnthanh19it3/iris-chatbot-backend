<?php

namespace App\Http\Controllers\Web\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    public function loginUI(Request $request){
        return view("admin.pages.auths.login");
    }
    public function authenticate(Request $request)
    {
        DB::enableQueryLog();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            $request-->session()->regenerate();
            dd(Auth::user()->email, session()->all());
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
