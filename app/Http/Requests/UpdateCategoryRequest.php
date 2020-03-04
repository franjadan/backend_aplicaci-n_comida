<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u'],
            'discount' => ['nullable', 'present', 'regex:/^\d+$/'],
            'image' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener más de dos caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'discount.present' => 'El campo descuento debe esta presente.',
            'discount.regex' => 'El campo descuento no es válido.',
        ];
    }

    public function updateCategory(Category $category)
    {
        if ($this->file('image') != null){
            $old = public_path()."/$category->image";
            if (@getimagesize($old)){
                unlink($old);
            }
            $new = $this->file('image');
            $name = $new->getClientOriginalName();
            $new->move('media/categories', $name);
            $category->update([
                'name' => $this['name'],
                'discount' => $this['discount'],
                'image' => "media/categories/$name",
            ]);
        }else{
            $category->update([
                'name' => $this['name'],
                'discount' => $this['discount'],
            ]);
        }
    }
}
