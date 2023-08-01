<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [
                'email' => 'unique:users,email',
                'name' => 'min:3|max:255',
                'address' => 'min:3',
                'password' 			=> 'min:8|max:255',
    			'repeat_password' 	=> 'same:password',
    			'phone' => 'min:10|numeric'
            ]
            ,
            [
                'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !',
                'address.min' => ':attribute must have at least 3 characters !',
                'password.min' 				=> ':attribute must be at least 8 characters long !',
    			'password.max' 				=> ':attribute must be a maximum of 255 characters long !',
    			'repeat_password.same' 		=>  ':attribute must be the same as the password fleid!',
    			'phone.min' 				=> ':attribute must be at least 10 characters long !',
    			'phone.numeric' 				=> ':attribute must be a number !',
            ]
            ,
            [
                'email' => 'Email',
                'name' => 'Name',
                'address' => 'Address',
                'password'		 	=> 'Password',
    			'repeat_password' 	=> 'Repeat Password',
    			'phone' => 'Phone'
            ]
        );

        if($validator->fails())
        {
        	return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
        	$data_user['email'] = $request->email;
        	$data_user['password'] = Hash::make($request->password);
        	$data_user['role'] = 0;
        	$user_id = User::create($data_user)->id;

        	$data_customer['user_id'] = $user_id;
        	$data_customer['name'] = $request->name;
        	$data_customer['address'] = $request->address;
        	$data_customer['phone'] = $request->phone;

        	Customer::create($data_customer);

        	$user = User::find($user_id);
        	Auth::login($user);
        	return response()->json(['res_type' => 'success', 'response' => 'Registered Account Successfully !']);
        }


    }
}
