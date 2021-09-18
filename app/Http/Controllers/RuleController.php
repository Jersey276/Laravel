<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        return view('admin/rules/list', ['rules' => Rule::all()]);
    }

    public function editForm(Rule $name)
    {
        return view('admin/rules/form',['rule' => $name, 'roles' => Role::all()]);
    }
    
    public function edit(Request $request, Rule $name)
    {
        $name->description = $request->description;
        foreach(Role::all() as $role)
        {
            if (isset($request->roles)) {
                if (in_array($role->name, $request->roles) && !$name->roles->contains($role)) {
                    $name->roles()->attach($role);
                } elseif (!in_array($role->name, $request->roles) && $name->roles->contains($role)) {
                    $name->roles()->detach($role->name);
                }
            } else {
                if ($name->roles->contains($role)) {
                    $role->rules()->detach($name->name);
                }
            }
        }
        $name->save();
        return redirect('/admin/rules');
    }
}
