<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class VerifyCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        //Redirect user to home if mobile already verified
        if ($request->user()->email_verified_at || $request->user()->mobile_verified_at) return redirect()->to(RouteServiceProvider::HOME);

        $request->validate([
            'code' => ['required', 'numeric'],
        ]);

        // Code correct
        if ($request->code === auth()->user()->verification_code) {
            // check if code is still valid
            $secondsOfValidation = (int) config('verification.seconds_of_validation');
            if ($secondsOfValidation > 0 &&  $request->user()->verification_code_sent_at->diffInSeconds() > $secondsOfValidation) {
                $request->user()->sendMobileVerificationNotification(true);
                return back()->withErrors(['error' => __('mobile.expired')]);
            }else {
                $request->user()->markMobileAsVerified();
                return redirect()->to(RouteServiceProvider::HOME)->with(['message' => __('mobile.verified')]);
            }
        }

        // Max attempts feature
        if (config('verification.max_attempts') > 0) {
            if ($request->user()->attempts_left <= 1) {
                if($request->user()->attempts_left == 1) $request->user()->decrement('attempts_left');

                //check how many seconds left to get unbanned after no more attempts left
                $seconds_left = (int) config('verification.attempts_ban_seconds') - $request->user()->last_attempt_date->diffInSeconds();
                if ($seconds_left > 0) {
                    return back()->withErrors(['error' => __('mobile.error_wait', ['seconds' => $seconds_left])]);
                }

                //Send new code and set new attempts when user is no longer banned
                $request->user()->sendMobileVerificationNotification(true);
                return back()->withErrors(['error' => __('mobile.new_code')]);
            }

            $request->user()->decrement('attempts_left');
            $request->user()->update(['last_attempt_date' => now()]);
            return back()->withErrors(['error' => __('mobile.error_with_attempts', ['attempts' => $request->user()->attempts_left])]);
        }

        return back()->withErrors(['error' => __('mobile.error_code')]);

    }
}
