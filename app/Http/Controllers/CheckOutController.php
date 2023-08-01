<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CheckOut;
class CheckOutController extends Controller
{
    public function index()
    {
    	$check_out = CheckOut::orderBy('id', 'DESC')->paginate(5);
    	return view('admin.pages.check-out', ['check_out' => $check_out]);
    }
}
