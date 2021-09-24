<?php

namespace App\Managers;

use App\Models\Role;
use App\Models\Rule;
use App\Models\User;

class RuleManager {
    
    public static function checkRule(string $name, User $user) : bool
    {
        $rule = Rule::find($name);
        if (!Rule::find($name) instanceOf Rule) {
            $rule = Rule::Create(
                ['name' => $name]
            );
            $rule->roles()->attach(Role::find('admin'));
        }
        // check user direct role
        /** @var User $user */
        $user_role = $user->role;
        if ($rule->roles->contains($user_role)) {
            return true;
        }
        if (json_decode($user_role->parents) != null) {
            foreach (json_decode($user_role->parents) as $role) {
                if ($rule->roles->contains($role)) {
                    return true;
                }
            }
        }
        return false;
    }
}