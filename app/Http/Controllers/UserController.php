<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPost;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordChange;

class UserController extends Controller
{

    public function admin()
    {
        $users = User::paginate(10);
        return view('users.admin',compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function create()
    {
        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $user= new User();
        $user->fill($validated_data);
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $user->fill($validated_data);
        $user->save();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy(User $user)
    {
        $oldName=$user->nome;
        $user->delete();
        return redirect()->route('admin.users')
                ->with('alert-msg', 'User "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }



    public function edit_password(){
        return view('auth.password_change');
    }
    public function update_password(PasswordChange $request){

        $user=auth()->user();
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.dashboard')
        ->with('alert-msg','Password alterada com sucesso')
        ->with('alert-type','success');
    }
}
