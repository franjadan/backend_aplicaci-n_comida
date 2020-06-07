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
use Auth;
use Mail;

class UserController extends Controller
{

    //Función que genera la vista que lista los usuarios
    public function index()
    {
        if (Auth::user()->role === "superadmin"){
            $users = User::query()
            ->where('role', '<>', 'superadmin')
            ->where('active', '=', 1)
            ->get();
        }else{
            $users = User::query()
            ->where('role', '<>', 'admin')
            ->where('active', '=', 1)
            ->get();
        }

        return view('users.index', [
            'users' => $users,
            'route' => 'index'
        ]);
    }

    public function trash(){
        if (Auth::user()->role === "superadmin"){
            $users = User::query()
            ->where('role', '<>', 'superadmin')
            ->where('active', '=', 0)
            ->get();
        }else{
            $users = User::query()
            ->where('role', '<>', 'admin')
            ->where('active', '=', 0)
            ->get();
        }

        return view('users.index', [
            'users' => $users,
            'route' => 'trash'
        ]);
    }

    //Función que genera la vista para crear los usuarios
    public function create()
    {
        $user = new User;

        if (Auth::user()->role == "superadmin"){
            $roles =  ['admin' => 'Admin', 'user' => 'Usuario', 'operator' => 'Operario'];
        }else{
            $roles =  ['user' => 'Usuario', 'operator' => 'Operario'];
        }

        return view('users.create', [
            'user' => $user,
            'route' => 'create',
            'roles' => $roles
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

        if(Auth::user()->role != "superadmin" && $user->role == "admin"){
            return redirect()->route('users.index')->with('error', 'No puedes acceder a este usuario');
        }

        if(Auth::user()->role == "superadmin" && $user->role == "superadmin"){
            return redirect()->route('users.index');
        }

        if (Auth::user()->role == "superadmin"){
            $roles =  ['admin' => 'Admin', 'user' => 'Usuario', 'operator' => 'Operario'];
        }else{
            $roles =  ['user' => 'Usuario', 'operator' => 'Operario'];
        }

        return view('users.edit', [
            'user' => $user,
            'route' => 'edit',
            'roles' => $roles
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

        if($user->active){
            return redirect()->route('users.trash')->with('success', 'Se han guardado los cambios.');
        }else{
            return redirect()->route('users.index')->with('success', 'Se han guardado los cambios.');
        }

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

    //Función para generar una nueva contraseña
    public function generatePassword(User $user)
    {
        $new_password = str_random(6);
        
        $subject = "Cambio de contraseña";
        $for = $user->email;

        $data['msg'] = "Se ha generado una nueva contraseña: $new_password";

        //Enviar por correo
        try{
            Mail::send('email.email', $data, function($message) use($subject,$for){
                $message->from("proyectofinalestechdam@gmail.com","Menu of the day");
                $message->subject($subject);
                $message->to($for);
            });

            if (Mail::failures()) {
                return redirect()->route('users.edit', $user)->with('error', 'No se ha podido enviar el correo');
            }else{
                $user->password = bcrypt($new_password);
                $user->save();

                return redirect()->route('users.edit', $user)->with('success', "Se ha enviado el correo");
            }
        }catch(Exception $ex){
            return redirect()->route('users.edit', $user)->with('error', $ex->getMessage());
        }
    }

    //Función api para generar una nueva contraseña
    public function api_generatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'] //Reglas
        ], [
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser válido' //Mensajes
        ]);

        if ($validator->fails()) {
            return response()->json(["response" => ["code" => -1, "data" => $validator->errors()]], 422);
        } else {
            $user = User::query()->where('email', $request->get('email'))->first();

            if($user == null){
                return response()->json(["response" => ["code" => -1, "data" => "No existe el usuario con este email"]], 422);
            }else{
                $new_password = str_random(6);
                $subject = "Cambio de contraseña";
                $for = $user->email;

                $data['msg'] = "Se ha generado una nueva contraseña: $new_password";

                //Enviar por correo
                try{
                    Mail::send('email.email', $data, function($message) use($subject,$for){
                        $message->from("proyectofinalestechdam@gmail.com","Menu of the day");
                        $message->subject($subject);
                        $message->to($for);
                    });

                    if (Mail::failures()) {
                        return response()->json(["response" => ["code" => -1, "data" => "No se ha podido enviar el correo"]], 502);
                    }else{
                        $user->password = bcrypt($new_password);
                        $user->save();

                        return response()->json(["response" => ["code" => 1, "data" => "Se ha enviado un correo con la nueva contraseña"]], 200);
                    }
                }catch(Exception $ex){
                    return response()->json(["response" => ["code" => -1, "data" => "No se ha podido enviar el correo"]], 502);

                }
            }
        }
    }
}
