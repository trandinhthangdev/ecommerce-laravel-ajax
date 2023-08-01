<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $table = 'news_comments';

    protected $fillable = [
    	'customer_id', 'news_id', 'content',
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function News()
    {
    	return $this->belongsTo('App\News');
    }
    
}
