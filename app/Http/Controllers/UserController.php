<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function editProfile() {
        $user = User::find(Auth::user()->id);
        return view('user.editprofile', compact('user'));
    }

    public function saveProfile(Request $request) {
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'password' => 'confirmed:confirm_password',
            'email' => 'unique:users,email,' . $user->id . ',id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if ($request->first_name) $user->first_name = $request->first_name;
        if ($request->last_name) $user->last_name = $request->last_name;
        if ($request->email) $user->email = $request->email;
        if ($request->password) $user->password = bcrypt($request->password);

        $user->save();

        return back();
    }
}
