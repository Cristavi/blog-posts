<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Login_controller extends Controller
{
    public function index(){
        return view('authentication.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login credentials');
        }

        return redirect()->route('blogs');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('blogs');
    }
}
