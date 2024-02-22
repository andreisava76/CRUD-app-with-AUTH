<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Exception;

class GoogleController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function google_page(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return RedirectResponse|void
     */
    public function google_callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::query()->where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);

                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                $newUser = User::query()->create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make(Str::random(30))
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
