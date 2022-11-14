<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function loginUI(Request $request){
        return '
            <form method="post" action="'. route('user.login') .'">
                <input type="hidden" name="_token" value="'. csrf_token() .'">
                <input name="email" type="text"><input name="password" type="text"><button type="submit">Login</button>
            </form>
        ';
    }
    public function authenticate(Request $request)
    {
//        dd(Hash::make("admin"));
        DB::enableQueryLog();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
//        ddd($credentials, Auth::attempt($credentials));
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            dd(Auth::user()->email, session()->all());
            return redirect()->intended('dashboard');
        }
        ddd("Fails", DB::getQueryLog());
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
