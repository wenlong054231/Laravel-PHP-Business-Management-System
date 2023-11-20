<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionExpirationCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && $request->session()->exists('lastActivity') && is_null(auth()->user()->name))
        {   
            $lastActivity = $request->session()->get('lastActivity');
            $expirationTime = 0.1; // 24 hours in minutes
            
            $isExpired = time() - $lastActivity > $expirationTime * 60;
            echo '<script>console.log("Time difference:", ' . (time() - $lastActivity) . ');</script>';
            echo '<script>console.log("Expiration time:", ' . ($expirationTime * 60) . ');</script>';
            echo '<script>console.log("Is session expired:", ' . ($isExpired ? 'true' : 'false') . ');</script>';

            if ((time() - $lastActivity > $expirationTime * 60)) {
                // Session expired, redirect to login page
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                // dd(auth()->check() && $request->session()->exists('lastActivity'));
              
                return redirect()->route('user.login')->with('error', 'Your session has expired. Please log in again.');
            }
          
        }else{
            if (!Auth::check() && $request->route()->getName() !== 'user.login'){
            return redirect()->route('user.login')->with('error', 'You must be logged in to access this page.');
            }
        }
        // return redirect()->route('user.login')->with('error', 'Your session has expired. Please log in again.');
        $request->session()->put('lastActivity', time());

        return $next($request);
    }
}
