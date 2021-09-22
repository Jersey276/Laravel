<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin/roles/list', ['roles' => $roles]);
    }
    
    public function create(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->parents = json_encode($request->parents);
        $role->save();
        return redirect('/admin/roles');
    }

    public function createForm()
    {
        $roles = Role::all();
        return view('admin/roles/form',['roles'=>$roles]);
    }

    public function edit($name, Request $request)
    {
        $role = Role::findOrFail($name);
        $role->name = $request->name;
        $role->parents = $request->parents;
        $role->save();
        return redirect('admin/roles');
    }
    
    public function editForm($name)
    {
        $roles = Role::all();
        $editRole = Role::findOrFail($name);
        return view('admin/roles/form',['roles'=>$roles, 'editRole' => $editRole]);
    }

    public function remove(string $name)
    {
        /** @var User[] $users */
        $users = User::where(['role'=>$name]);
        $userRole = User::find('user');
        foreach($users as $user) {
            $user->role()->dissociate();
            $user->role()->associate($userRole);
            $user->save();
        }
        Role::findOrFail($name)->delete();
        return redirect('/admin/roles');
    }
}