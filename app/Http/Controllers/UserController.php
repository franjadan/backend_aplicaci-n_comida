<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->ajax()) {
            return Datatables::of($users)
                    ->addColumn('name', function($row){

                        $tipo = "";
                        $active = "";

                        if($row->isAdmin()){
                            $tipo = " (Admin)";
                        }

                        if($row->active){
                            $active = "<span class='status st-active'></span>";
                        }else{
                            $active = "<span class='status st-inactive'></span>";
                        }

                        $result = "<td><h5>" . $row->first_name . " " . $row->last_name . "" . $tipo . "" . $active . "</h5></td>";
                        return $result;

                    })
                    ->addColumn('actions', function($row){
                            $actions = "<form action='". route('users.destroy', $row) . "' method='POST'>" .csrf_field() . "" . method_field('DELETE') . "<a class='btn btn-primary mr-1' href='" . route('users.edit', ['user' => $row]) . "'><i class='fas fa-edit'></i></a><button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button></form>";
                            return $actions;
                    })
                    ->rawColumns(['name', 'actions'])
                    ->make(true);
        }

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

        return redirect()->route('users.edit', ['user' => $user])->with('success', 'Se han guardado los cambios.');
    }

    public function changeStatus(User $user)
    {

        if($user->active) {
            $user->active = false;
        } else {
            $user->active = true;
        }

        $user->save();

        return redirect()->route('users.edit', ['user' => $user])->with('success', 'Se han guardado los cambios.');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Se ha eliminado con éxito.');
    }
}
