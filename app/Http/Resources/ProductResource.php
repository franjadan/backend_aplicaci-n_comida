<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'available' => $this->available,
            'image' => asset($this->image),
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'ingredients' => IngredientResource::collection($this->ingredients),
        ];
    }
}
