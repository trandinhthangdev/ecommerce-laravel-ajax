<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSlider extends Model
{
    protected $table = 'product_sliders';

    protected $fillable = [
    	'product_id', 'image',
    ];
}
