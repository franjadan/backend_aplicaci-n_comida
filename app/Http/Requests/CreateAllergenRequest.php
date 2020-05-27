<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic as Image;
use App\Allergen;

class CreateAllergenRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u', 'unique:allergens,name']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'name.unique' => 'El campo nombre no pude coincidir con el de otro alérgeno.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El campo imagen no es válido',
        ];
    }

    public function createAllergen()
    {
        $image = $this->file('image');
        $name = $image->getClientOriginalName();
        $root = public_path('media/allergens/'.$name);

        Image::make($image->getRealPath())->resize(150, 150, function($constraint) {
            $constraint->aspectRatio();
        })->save($root, 72);

        Allergen::create([
            'name' => $this['name'],
            'image' => "media/allergens/$name",
        ]);
    }
}
