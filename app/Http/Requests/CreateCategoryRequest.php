<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic as Image;
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
        $root = public_path('media/categories/'.$name);

        Image::make($image->getRealPath())->resize(600, 400, function($constraint) {
            $constraint->aspectRatio();
        })->save($root, 72);

        $root = public_path('media/categories/min/'.$name);
        Image::make($image->getRealPath())->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        })->save($root, 72);

        Category::create([
            'name' => $this['name'],
            'image' => "media/categories/$name",
            'min' => "media/categories/min/$name",
        ]);
    }
}
