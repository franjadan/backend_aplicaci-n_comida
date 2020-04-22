<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class AvailableProductRequest extends FormRequest
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
            'available' => ['required'],
        ];
    }

    public function message()
    {
        return [
            'available.required' => 'El campo disponible es obligatorio.',
        ];
    }

    public function availableProduct(Product $product)
    {
        $available = $this['available'] == 'yes'? true: false;

        $product->update([
            'available' => $available,
        ]);
    }
}
