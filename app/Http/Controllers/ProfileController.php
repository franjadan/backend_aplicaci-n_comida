<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
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
            'old_password.required' => 'El campo antigua contraseña es obligatorio',
            'new_password.required' => 'El campo nueva contraseña es obligatorio',
            'new_password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'verify_password.required' => 'El campo repetir contraseña es obligatorio',
            'verify_password.same' => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            
            return redirect(route('profile.changePassword'))->withErrors($validator)->withInput();

        } else {

            if(!Hash::check($request->get('old_password'), $user->password)){
                $validator->getMessageBag()->add('old_password', 'La contraseña antigua no coincide con tu contraseña actual');
                return back()->withErrors($validator)->withInput();
            }

            $user->forceFill([
                'password' => bcrypt($request->get('new_password'))
            ]);

            $user->save();

            
            return redirect()->route('profile.index')->with('success', 'Se han guardado los cambios');

        }
    }
}
