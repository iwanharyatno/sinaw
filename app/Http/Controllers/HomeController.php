<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {
        $user = null;

        if (Auth::user() != null) {
            $user = User::find(Auth::user()->id);
        }

        return view("home.index", compact('user'));
    }

    public function register() {
        return view('home.register');
    }

    public function handleRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $data = $validator->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        Auth::loginUsingId($user->id);

        return redirect()->intended();
    }

    public function handleLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if (Auth::attempt($validator->validated())) {
            return redirect()->intended();
        } else {
            return back()->withErrors([
                'general' => 'User not found!'
            ])->withInput();
        }
    }
 
    public function login() {
        return view("home.login");
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->regenerate();

        return redirect()->route('home.index');
    }
    
}
