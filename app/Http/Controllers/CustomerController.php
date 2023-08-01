<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
{
    public function index()
    {
    	$customer = Customer::orderBy('id', 'DESC')->paginate(5);
    	return view('admin.pages.customer', ['customer' => $customer]);
    }
}
