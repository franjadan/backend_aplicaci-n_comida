<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderBy('id')
            ->paginate();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $user = new User;
        return view('users.create', [
            'user' => $user,
            'roles' => ['admin' => 'Admin', 'user' => 'Usuario']
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users.index')->with('success', 'Se ha creado el usuario con éxito.');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => ['admin' => 'Admin', 'user' => 'Usuario']
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('users.edit', ['user' => $user])->with('success', 'Se han guardado los cambios');
    }

    public function changeStatus(User $user)
    {

        if($user->active) {
            $user->active = false;
        } else {
            $user->active = true;
        }

        $user->save();

        return redirect()->route('users.edit', ['user' => $user])->with('success', 'Se han guardado los cambios');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Se ha eliminado con éxito');
    }
}
