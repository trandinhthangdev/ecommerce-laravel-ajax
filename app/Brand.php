<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
    	'category_id', 'name', 'slug', 'status',
    ];

    public function Category()
    {
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
