<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedProduct extends Model
{
    protected $table = 'received_products';

    protected $fillable = [
    	'customer_id', 'product_id',
    ];
}
