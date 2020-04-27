<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\User;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['nullable', 'present'],
            'last_name' => ['nullable', 'present'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'address' => ['nullable', 'present'],
            'phone' => ['nullable', 'present', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'role' => ['required', Rule::in(['admin', 'user', 'operator'])],
        ];
    }

    //Mensajes
    public function messages()
    {
        return [
            'first_name.present' => 'El campo nombre debe estar presente',
            'last_name.present' => 'El campo apellido debe estar presente',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser válido',
            'email.unique' => 'El campo email debe ser único',
            'address.present' => 'El campo dirección debe estar presente',
            'phone.present' => 'El campo teléfono debe estar presente',
            'phone.regex' => 'El teléfono debe ser válido',
            'role.required' => 'El campo rol es obligatorio',
            'role.in' => 'El rol debe ser válido',
        ];
    }

    //Función que actualiza el usuario en la bd
    public function updateUser(User $user)
    {

        //Rellena el usuario con los datos
        $user->forceFill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'role' => $this->role ?? 'user'
        ]);

        $user->save();

    }

}
