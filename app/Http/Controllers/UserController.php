<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
