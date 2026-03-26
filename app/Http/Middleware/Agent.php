<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Agent
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
        $agentProfile = $user->agent()->latest()->first(); // pick latest if multiple

        if (!$agentProfile) {
            // No merchant profile yet → redirect to onboarding
            return redirect()->route('createRole', ['role' => 'agent']);
        }

        if ($agentProfile->status !== 'complete') {
            // Profile exists but incomplete → redirect to onboarding
            return redirect()->route('createRole', ['role' => 'agent']);
        }

        // Profile exists and complete → allow access
        return $next($request);
    }
}
