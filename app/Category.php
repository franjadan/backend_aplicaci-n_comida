<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'min'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function scopeSearch($query)
    {
        $query->when(request('search'), function($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        });
    }
}
