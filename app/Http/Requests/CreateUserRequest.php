<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\User;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Autorizado a todo el mundo
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

     //Reglas de validación
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'present', 'min:6'],
            'address' => 'required',
            'phone' => ['required', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'role' => ['required', Rule::in(['admin', 'user', 'operator'])],
        ];
    }

    //Mensajes de error
    public function messages()
    {
        return [
            'first_name.required' => 'El campo nombre es obligatorio',
            'last_name.required' => 'El campo apellido es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser válido',
            'email.unique' => 'El campo email debe ser único',
            'password.required' => 'El campo contraseña debe ser obligatorio',
            'password.min' => 'El campo contraseña debe tener mínimo 6 caracteres',
            'address.required' => 'El campo dirección es obligatorio',
            'phone.required' => 'El campo teléfono es obligatorio',
            'phone.regex' => 'El teléfono debe ser válido',
            'role.required' => 'El campo rol es obligatorio',
            'role.in' => 'El rol debe ser válido',
        ];
    }

    //Función que guarda el usuario en la bd
    public function createUser()
    {
        DB::transaction(function () {

            $user = new User();

            //Rellena el usuario con los datos
            $user->forceFill([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => bcrypt($this->password), //Encripta la contraseña
                'address' => $this->address,
                'phone' => $this->phone,
                'role' => $this->role ?? 'user',
                'active' => true
            ]);

            $user->save();

        });
    }
}
