<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/users/list', ['users' => User::all()]);
    }

    public function detail()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(string $name, Request $request)
    {
        /** @var User $user */
        $user = User::where(['name' => $name])->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role()->dissociate();
        $user->role()->associate(Role::findOrFail($request->role));
        $user->save();

        return redirect('/admin/users');
    }

    public function editForm(string $name)
    {
        return view('/admin/users/form',['user' => User::where(['name' => $name])->first(), 'roles' => Role::all()]);
    }
}
