<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Rule;
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
        $rule = Rule::firstOrCreate(
            ['name' => $name]
        );
        if ($rule->roles()->count() === 0) {
            $rule->roles()->attach(Role::find('admin'));
        }
        // check user direct role
        /** @var User $user */
        $user_role = (Auth::user())->role;
        if ($rule->roles->contains($user_role->name)) {
            return $next($request);
        }
        if (json_decode($user_role->parents) != null) {
            foreach (json_decode($user_role->parents) as $role) {
                if ($rule->roles->contains($role)) {
                    return $next($request);
                }
            }
        }
        abort(403, 'Access denied');
    }

}
