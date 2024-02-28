<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthOtpController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function login(): Factory|View|Application
    {
        return view('auth.otp-login');
    }


    /**
     * @param Request $request
     * @return object
     */
    public function generate(Request $request): object
    {
        $request->validate([
            'mobile_no' => ['required', 'exists:users,mobile_no']
        ]);

        $user = User::query()->where('mobile_no', $request->get('mobile_no'))->first();

        $verification_code = Verification::query()->where('user_id', $user->id)->latest()->first();
        if ($verification_code && now()->isBefore($verification_code->expired_at)) {
            return $verification_code;
        }

        return Verification::query()->create([
            'user_id' => $user->id,
            'otp' => rand(100000, 999999),
            'expired_at' => now()->addMinutes(10)
        ]);
    }
}
