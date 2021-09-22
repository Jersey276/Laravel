<?php

namespace App\Http\Middleware;

use App\Managers\RuleManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, String $name)
    {
        if(RuleManager::checkRule($name, Auth::user())) {
            return $next($request);
        }
        abort(403, 'Access denied');
    }

}
