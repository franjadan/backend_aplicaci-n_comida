<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Order;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['nullable', 'present', Rule::exists('users', 'id')],
            'guest_name' => ['nullable', 'present'],
            'guest_address' => ['nullable', 'present'],
            'guest_phone' => ['nullable', 'present', 'regex:/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/'],
            'products' => ['required', 'array', Rule::exists('products', 'id')],
            'estimated_time' => ['required', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'real_time' => ['nullable', 'present', 'regex:/[0-9][0-9]:[0-9][0-9]/'],
            'comment' => ['nullable', 'present'],
            'paid' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'user_id.present' => 'El campo usuario debe esta presente',
            'user_id.exists' => 'El campo usuario debe ser válido',
            'guest_name.present' => 'El campo nombre del invitado debe estar presente',
            'guest_address.present' => 'El campo dirección del invitado debe estar presente',
            'guest_phone.present' => 'El campo teléfono del invitado debe estar presente',
            'products.required' => 'El campo productos es obligatorio',
            'products.exists' => 'El campo productos debe ser válido',
            'estimated_time.required' => 'El campo hora de recogida es obligatorio',
            'estimated_time.regex' => 'El campo hora de recogida debe ser válido',
            'estimated_time.present' => 'El campo hora de recogida real debe estar presente',
            'estimated_time.regex' => 'El campo hora de recogida real debe ser válido',
            'comments.present' => 'El campo observaciones debe estar presente',
            'paid.required' => 'El campo pagado es obligatorio',
            'paid.boolean' => 'El campo pagado no es válido'
        ];
    }

    public function updateOrder(Order $order)
    {

        if($this->user_id != null){
            if(!empty($this->guest_name) || !empty($this->guest_address) || !empty($this->guest_phone)){
                return 'El pedido sólo podrá realizarse con un usuario registrado o invitado';
            }
        }else{
            if(empty($this->guest_name) || empty($this->guest_address) || empty($this->guest_phone)){
                return 'Debe haber un usuario registrado o datos de invitado';
            }
        }


        $order->forceFill([
            'user_id' => $this->user_id,
            'guest_name' => $this->guest_name,
            'guest_address' => $this->guest_address,
            'guest_phone' => $this->guest_phone,
            'estimated_time' => $this->estimated_time,
            'state' => 'pending',
            'real_time' => $this->real_time,
            'comment' => $this->comment,
            'paid' => $this->paid
        ]);

        $order->save();

        $order->products()->sync($this->products);

        return '';

    }
}