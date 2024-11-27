<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {
        return view("home.index");
    }

    public function register() {
        return view('home.register');
    }

    public function handleRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
    }
 
    public function login() {
        return view("home.login");
    }

    
}
