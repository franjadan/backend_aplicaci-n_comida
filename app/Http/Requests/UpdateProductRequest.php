<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Rule;
use App\Product;

class UpdateProductRequest extends FormRequest
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
            'description' => ['required', 'min:5', 'regex:/^[\pL\s\-\.]+$/u'],
            'available' => ['required'],
            'image' => ['nullable', 'image'],
            'name' => ['required', 'min:2', 'regex:/^[\pL\s\-]+$/u', Rule::unique('products', 'name')->ignore($this->product)],
            'price' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric', 'present'],
            'categories' => ['required', 'array', 'exists:categories,id'],
            'ingredients' => ['required', 'array', 'exists:ingredients,id'],
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'El campo descripción es obligatorio.',
            'description.min' => 'El campo descripción debe tener mínimo 5 caracteres.',
            'description.regex' => 'El campo descripción no es válido.',
            'available.required' => 'El campo disponible es obligatorio.',
            'image.image' => 'El campo imagen no es válido.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El campo nombre no es válido.',
            'name.unique' => 'El campo nombre no puede coincidir con el de otro producto.',
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El campo precio no es válido.',
            'discount.numeric' => 'El campo descuendo no es válido.',
            'discount.present' => 'El campo descuento debe estar presente.',
            'categories.required' => 'El campo categorías es obligatorio.',
            'categories.array' => 'El campo categorías no es válido.',
            'categories.exists' => 'El campo categorías no es válido.',
            'ingredients.required' => 'El campo ingredientes es obligatorio',
            'ingredients.array' => 'El campo ingredientes no es válido.',
            'categories.exists' => 'El campo ingredientes no es válido.',
        ];
    }

    public function updateProduct(Product $product)
    {
        $available = $this['available'] == 'yes'? true: false;

        if ($this->file('image') != null){
            $images = Product::where('image', '=', $product->image)->get();
            $old = public_path($product->image);
            if (@getimagesize($old) && count($images) <= 1){
                unlink($old);
                $old = public_path($product->min);
                unlink($old);
            }
            $new = $this->file('image');
            $name = $new->getClientOriginalName();
            $root = public_path('media/products/'.$name);

            Image::make($new->getRealPath())->resize(600, 400, function($constaint) {
                $constaint->aspectRatio();
            })->save($root, 72);

            $root = public_path('media/products/min/'.$name);
            Image::make($new->getRealPath())->resize(300, 300, function($constraint) {
                $constraint->aspectRatio();
            })->save($root, 72);

            $product->update([
                'description' => $this['description'],
                'available' => $available,
                'image' => "media/products/$name",
                'min' => "media/products/min/$name",
                'name' => $this['name'],
                'price' => $this['price'],
                'discount' => $this['discount'],
            ]);
        }else{
            $product->update([
                'description' => $this['description'],
                'available' => $available,
                'name' => $this['name'],
                'price' => $this['price'],
                'discount' => $this['discount'],
            ]);
        }

        $product->categories()->sync($this['categories']);
        $product->ingredients()->sync($this['ingredients']);
    }
}
