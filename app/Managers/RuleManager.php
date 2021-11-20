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

    public static function getUsersAuthorized(string $name) : ?array
    {
        $rule = Rule::find($name);
        $roles = Role::all();

       $concernedRoles = collect([]);
        foreach ($roles as $role) {
            if ($role->rules->contains($rule)) {
                $concernedRoles->add($role);
            }
        }
        if ($concernedRoles->count() == 0) {
            return null;
        }
        $authorizedUsers = [];
        foreach ($concernedRoles->all() as $role) {
        $authorizedUsers =  array_merge($role->users->all(),$authorizedUsers);
        }

        return $authorizedUsers;
    }
}