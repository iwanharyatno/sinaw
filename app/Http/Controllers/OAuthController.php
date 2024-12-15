<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('gauth_id', $user->id)->first();

        if ($finduser) {

            Auth::login($finduser);

            return redirect()->route('home.index');
        } else {
            $nameSplit = explode(' ', $user->name);
            $firstName = $nameSplit[0];
            unset($nameSplit[0]);
            $nameSplit = array_values($nameSplit);
            $lastName = implode(' ', $nameSplit);
            $newUser = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'gauth_id' => $user->id,
                'gauth_type' => 'google',
                'password' => encrypt('admin@123')
            ]);

            Auth::login($newUser);

            return redirect()->route('home.index');
        }
    }
}
