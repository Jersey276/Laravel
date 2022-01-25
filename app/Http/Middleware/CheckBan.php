<?php

namespace App\Http\Middleware;

use App\Managers\UserManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $manager = new UserManager();
        if(auth()->check() && $manager->isBanned(auth()->user())) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('status-type','danger')->with('status-message','Le compte a été bannis, contactez un administrateur pour plus d\'information');
        }
        return $next($request);
    }
}
