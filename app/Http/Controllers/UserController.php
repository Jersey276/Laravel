<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin/users/list', ['users' => User::all(), 'function' => 'all']);
    }

    /**
     * Display all public information of an user
     */
    public function detail(string $name)
    {
        return view('/users/detail', ['user' => User::where(['name' => $name])->first()]);
    }

    /**
     * 
     */
    public function edit(Request $request)
    {
        /** @var User $user */
        $user = User::find(Auth::user()->id);
        $isEmailUpdated = false;
        if ($user->email != $request->email) {
            $user->email_verified_at == null;
            $isEmailUpdated = true;
        }
        $user->email = $request->email;
        $user->biography = $request->biography;
        $user->save();
        if ($isEmailUpdated) {
            $user->sendEmailVerificationNotification();
        }
        return redirect('users/'.$user->name);
    }

    public function changeAvatar(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->storeAs(
                'public',
                'avatar/'.$user->name . '.' . $avatar->getClientOriginalExtension(),
            );
        } else {
            $this->errorFlash($request, "Aucune image n'a été trouvé");
            return back();
        }
        $user->avatar = $user->name . '.' . $avatar->getClientOriginalExtension();
        $user->save();
        $this->successFlash($request, "L'avatar a été uploadé avec succes");
        return redirect('users/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminEdit(string $name, Request $request)
    {
        /** @var User $user */
        $user = User::where(['name' => $name])->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role()->dissociate();
        $user->role()->associate(Role::findOrFail($request->role));
        if($user->save()) {
            $this->successFlash($request, 'L\'utilisateur'. $user->name.' a été modifié avec succès');
            return redirect('/admin/users');
        }
        $this->errorFlash($request, 'L\'utilisateur'.$user->name.'n\'a pu être modifié avec succès');
        return back();
    }

    public function editForm()
    {
        return view('/users/form',['user' => Auth::user()]);
    }

    public function adminEditForm(string $name)
    {
        return view('/admin/users/form',['user' => User::where(['name' => $name])->first(), 'roles' => Role::all()]);
    }

    public function remove(string $name)
    {
        /** @var User $user */
        User::where(['name' => $name])->firstOrFail()->delete();
        if((Auth::user())->name === $name) {
            Auth::logout();
            return redirect('/');
        }
        return redirect('/admin/users');
    }
}
