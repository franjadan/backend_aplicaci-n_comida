<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'guest_name' => $this->guest_name,
            'guest_address' => $this->guest_address,
            'guest_phone' => $this->guest_phone,
            'guest_token' => $this->guest_token,
            'order_date' => $this->order_date,
            'estimated_time' => $this->estimated_time,
            'real_time' => $this->real_time,
            'state' => $this->state,
            'paid' => $this->paid,
            'comment' => $this->comment,
            'products' => ProductResource::collection($this->products),
        ];
    }
}
