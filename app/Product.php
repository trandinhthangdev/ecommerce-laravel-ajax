<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
    	'category_id', 'brand_id', 'name', 'slug', 'description', 'overview', 'quantity', 'price', 'discount_price', 'thumbnail', 'status', 'featured', 'star',
    ];

}
