<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favourite_order_name', 'guest_name', 'guest_adress', 'guest_phone', 'order_date', 'estimated_time', 'real_time', 'comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'guest_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    'paid' => 'bool'
    ];

    public function products()
    {
        return $this->belongsToMany(Category::class, 'order_products');
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}
