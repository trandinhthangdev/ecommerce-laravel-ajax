<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $table = 'stars';

    protected $fillable = [
    	'customer_id', 'product_id', 'number_star', 'content',
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
