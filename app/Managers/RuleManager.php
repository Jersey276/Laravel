<?php

namespace App\Managers;

use App\Models\Role;
use App\Models\Rule;
use App\Models\User;

class RuleManager {
    
    public static function checkRule(string $name, User $user) : bool
    {

        if (Rule::find(['name' => $name]) instanceof Rule) {
            $rule = Rule::firstOrCreate(
                ['name' => $name]
            );
            $rule->roles()->attach(Role::find('admin'));
        } else {
            $rule = Rule::find($name);
        }
        // check user direct role
        /** @var User $user */
        $user_role = $user->role;
        if ($rule->roles->contains($user_role->name)) {
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