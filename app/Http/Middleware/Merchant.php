<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Merchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user has a merchant profile
        $merchantProfile = $user->merchant()->latest()->first(); // pick latest if multiple

        if (!$merchantProfile) {
            // No merchant profile yet → redirect to onboarding
            return redirect()->route('createRole', ['role' => 'merchant']);
        }

        if ($merchantProfile->status !== 'complete') {
            // Profile exists but incomplete → redirect to onboarding
            return redirect()->route('createRole', ['role' => 'merchant']);
        }

        // Profile exists and complete → allow access
        return $next($request);
    }
}
