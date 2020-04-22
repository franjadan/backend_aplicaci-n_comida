<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DataTables;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    //Función que genera la vista que lista los usuarios
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    //Función que genera la vista para crear los usuarios
    public function create()
    {
        $user = new User;
        return view('users.create', [
            'user' => $user,
            'roles' => ['admin' => 'Admin', 'user' => 'Usuario', 'operator' => 'Operario']
        ]);
    }

    //Función que llama al request que se encarga de la creación de usuarios
    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users.index')->with('success', 'Se ha creado el usuario con éxito.');
    }

    //Función que genera la vista para editar el usuario
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => ['admin' => 'Admin', 'user' => 'Usuario', 'operator' => 'Operario']
        ]);
    }

    //Función que llama al request para editar al usuario
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('users.edit', ['user' => $user])->with('success', 'Se han guardado los cambios.');
    }

    //Función que cambia el estado del usuario en la bd
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

    //Función para eliminar al usuario
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Se ha eliminado con éxito.');
    }

    //Función para registrar un usuario a través de la API
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'present', 'min:6'],
            'address' => 'required',
            'phone' => ['required', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'], //Reglas
        ], [
            'first_name.required' => 'El campo nombre es obligatorio',
            'last_name.required' => 'El campo apellido es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser válido',
            'email.unique' => 'El campo email debe ser único',
            'password.required' => 'El campo contraseña debe ser obligatorio',
            'password.min' => 'El campo contraseña debe tener mínimo 6 caracteres',
            'address.required' => 'El campo dirección es obligatorio',
            'phone.required' => 'El campo teléfono es obligatorio',
            'phone.regex' => 'El teléfono debe ser válido', //Mensajes
        ]);

        if ($validator->fails()) {
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 422);
        } else {

            $user = new User();

            //Rellena al usuario con los datos
            $user->forceFill([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'role' => 'user',
                'active' => true
            ]);

            $user->save();

            $token = JWTAuth::fromUser($user);

            $data = compact('user','token');
            return response()->json(["response" => ["code" => 1, "data" => $data]], 201);

        }
    }

    //Función para enviar los datos del usuario a través de la API
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(["response" => ["code" => -1, "data" => "El email o la contraseña no coinciden con ningún registro"]], 400);
            }
        } catch (JWTException $e) {
            return response()->json(["response" => ["code" => -1, "data" => "No se ha podido crear un token"]], 500);
        }

        $user = DB::table('users')->where('email', $request->get('email'))->first();

        $data = compact('user','token');
        return response()->json(["response" => ["code" => 1, "data" => $data]], 200);
    }
}
