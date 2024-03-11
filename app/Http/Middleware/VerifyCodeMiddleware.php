<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyCodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */

    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $user = auth()->user();

        if ($user->email_verified_at || $user->mobile_verified_at) {
            return $next($request);
        }

        return redirect()->route('verification.notice');
    }
}
