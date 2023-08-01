<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
    	'customer_id', 'message',
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
