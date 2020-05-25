<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Rule;
use App\Category;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u', Rule::unique('categories', 'name')->ignore($this->category)],
            'image' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'name.unique' => 'El campo nombre no puede coincidir con el de otra categoría.',
            'image.image' => 'El campo imagen no es válido',
        ];
    }

    public function updateCategory(Category $category)
    {
        if ($this->file('image') != null){
            $images = Category::where('image', '=', $category->image)->get();
            $old = public_path($category->image);
            if (@getimagesize($old) && count($images) <= 1){
                unlink($old);
                $old = public_path($category->min);
                unlink($old);
            }
            $new = $this->file('image');
            $name = $new->getClientOriginalName();
            $root = public_path('media/categories/'.$name);

            Image::make($new->getRealPath())->resize(600, 400, function($contraint) {
                $contraint->aspectRatio();
            })->save($root, 72);

            $root = public_path('media/categories/min/'.$name);
            Image::make($new->getRealPath())->resize(300, 300, function($contraint) {
                $contraint->aspectRatio();
            })->save($root, 72);

            $category->update([
                'name' => $this['name'],
                'image' => "media/categories/$name",
                'min' => "media/categories/min/$name",
            ]);
        }else{
            $category->update([
                'name' => $this['name'],
            ]);
        }
    }
}
