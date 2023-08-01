<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
	protected $table = 'check_outs';

    protected $fillable = [
    	'customer_id', 'order_detail', 'status', 'token_check_out'
    ];

    public function Customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
