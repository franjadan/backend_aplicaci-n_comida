<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Category;

class CreateCategoryRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u'],
            'image' => ['required', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'image.required' => 'El campo imagen es obligatorio.',
            'image.image' => 'El campo imagen no es válido',
        ];
    }

    public function createCategory()
    {
        $image = $this->file('image');
        $name = $image->getClientOriginalName();
        if (!@getimagesize(public_path()."/$name")){
            $image->move('media/categories', $name);
        }

        Category::create([
            'name' => $this['name'],
            'image' => "media/categories/$name",
        ]);
    }
}
