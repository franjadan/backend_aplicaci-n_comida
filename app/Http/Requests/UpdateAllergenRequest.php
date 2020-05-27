<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Rule;
use App\Allergen;

class UpdateAllergenRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u', Rule::unique('allergens', 'name')->ignore($this->allergen)],
            'image' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'name.unique' => 'El campo nombre no puede coincidir con el de otro alérgeno.',
            'image.image' => 'El campo imagen no es válido',
        ];
    }

    public function updateAllergen(Allergen $allergen)
    {
        if ($this->file('image') != null) {
            $images = Allergen::where('image', '=', $allergen->image)->get();
            $old = public_path($allergen->image);
            if (@getimagesize($old) && count($images) <= 1) {
                unlink($old);
            }
            $new = $this->file('image');
            $name = $new->getClientOriginalName();
            $root = public_path('media/allergens/'.$name);

            Image::make($new->getRealPath())->resize(150, 150, function($contraint) {
                $contraint->aspectRatio();
            })->save($root, 72);

            $allergen->update([
                'name' => $this['name'],
                'image' => "media/allergens/$name",
            ]);
        } else {
            $allergen->update([
                'name' => $this['name'],
            ]);
        }
    }
}
