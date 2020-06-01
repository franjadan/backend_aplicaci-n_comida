<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();

        return view('profile.index', [
            'user' => $user,
        ]);
    }

    //Función para mostrar la vista del cambio de contraseña
    public function edit()
    {
        return view('profile.changePassword', [
            'user' => Auth::user()
        ]);
    }

    //Función que cambia la contraseña en la bd
    public function update(Request $request)
    {

        $user = Auth::user();

        $rules = [
            'old_password' => ['required'],
            'new_password' => ['required', 'min:6'],
            'verify_password' => ['required', 'same:new_password']
        ];

        $messages = [
            'old_password.required' => 'El campo antigua contraseña es obligatorio.',
            'new_password.required' => 'El campo nueva contraseña es obligatorio.',
            'new_password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
            'verify_password.required' => 'El campo repetir contraseña es obligatorio.',
            'verify_password.same' => 'Las contraseñas no coinciden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect(route('profile.changePassword'))->withErrors($validator)->withInput();

        } else {

            if(!Hash::check($request->get('old_password'), $user->password)){
                $validator->getMessageBag()->add('old_password', 'La contraseña antigua no coincide con tu contraseña actual.');
                return back()->withErrors($validator)->withInput();
            }

            $user->forceFill([
                'password' => bcrypt($request->get('new_password'))
            ]);

            $user->save();


            return redirect()->route('profile.index')->with('success', 'Se han guardado los cambios.');

        }
    }

    public function api_updateProfile(Request $request)
    {
        $rules = [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->user())],
            'address' => ['required'],
            'phone' => ['required', 'regex:/(\+34|0034|34)?[ -]*(6|7|8|9)[ -]*([0-9][ -]*){8}/'],
        ];

        $messages = [
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El campo usuario debe ser válido.',
            'first_name.required' => 'El campo nombre es obligatorio.',
            'last_name.required' => 'El campo apellido es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email no es válido.',
            'email.unique' => 'El campo email no puede coincidir con el de otro usuario.',
            'address.required' => 'El campo dirección es obligatorio.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.regex' => 'El campo teléfono no es válido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['response' => ['code' => -1, 'data' => $validator->errors()]], 400);
        }else {
            if($request->get('user_id') == auth()->user()->id) //Para que el id coincida con el usuario del token
            {
                $user = User::query()->where('id', $request->get('user_id'))->first();
                $user->forceFill([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'address' => $request->get('address'),
                    'phone' => $request->get('phone'),
                ]);
                $user->save();
                return response()->json(['response' => ['code' => 1, 'data' => $user]], 200);
            }else{
                return response()->json(['response' => ['code' => -1, 'data' => "No puedes modificar otro perfil."]], 400);
            }
        }
    }

    public function api_passwordUpdate(Request $request)
    {
        $rules = [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'old_password' => ['required'],
            'new_password' => ['required', 'min:6'],
            'verify_password' => ['required', 'same:new_password']
        ];

        $messages = [
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El campo usuario debe ser válido.',
            'old_password.required' => 'El campo antigua contraseña es obligatorio.',
            'new_password.required' => 'El campo nueva contraseña es obligatorio.',
            'new_password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
            'verify_password.required' => 'El campo repetir contraseña es obligatorio.',
            'verify_password.same' => 'Las contraseñas no coinciden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return response()->json(['response' => ['code' => -1, 'data' => $validator->errors()]], 400);

        } else {
            $user = User::query()->where('id', $request->get('user_id'))->first();

            if($request->get('user_id') == auth()->user()->id) //Para que el id coincida con el usuario del token
            {
                if(!Hash::check($request->get('old_password'), $user->password)){
                    return response()->json(['response' => ['code' => -1, 'data' => 'La contraseña antigua no coincide con tu contraseña actual.']], 400);
                }

                $user->forceFill([
                    'password' => bcrypt($request->get('new_password'))
                ]);

                $user->save();

                return response()->json(['response' => ['code' => 1, 'data' => "Se ha cambiado la contraseña con éxito."]], 200);
            }else{
                return response()->json(['response' => ['code' => -1, 'data' => "No puedes modificar la contraseña de otro usuario."]], 400);
            }
        }
    }
}
