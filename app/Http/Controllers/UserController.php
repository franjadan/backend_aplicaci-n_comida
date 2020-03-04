<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CreateUserRequest;

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

        return redirect()->route('users.index');
    }
}
