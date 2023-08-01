<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    protected $table = 'product_comments';

    protected $fillable = [
    	'customer_id', 'product_id', 'content',
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function Product()
    {
    	return $this->belongsTo('App\Product');
    }
}
