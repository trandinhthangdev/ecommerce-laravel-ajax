<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	$admin = User::where('role', 1)->paginate(5);
    	return view('admin.pages.admin', ['admin' => $admin]);
    } 
}
