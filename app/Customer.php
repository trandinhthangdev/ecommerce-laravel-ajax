<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
    	'user_id', 'name', 'address', 'phone',
    ];

    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
