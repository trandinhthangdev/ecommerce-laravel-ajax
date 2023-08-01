<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [
                'password' 			=> 'min:8|max:255'
            ]
            ,
            [
                'password.min' 				=> ':attribute must be at least 8 characters long !',
    			'password.max' 				=> ':attribute must be a maximum of 255 characters long !'
            ]
            ,
            [
                'password'		 	=> 'Password'
            ]
        );

        if($validator->fails())
        {
        	return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
        	$email = $request->email;
        	$password = $request->password;
        	$remember = $request->remember;
        	if(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 0], $remember))
        	{
        		return response()->json(['res_type' => 'success', 'response' => 'Login Successfully !']);
        	}
        	else
        	{
        		return response()->json(['res_type' => 'error', 'response' => 'Login Unsuccessfully !']);
        	}
        }
    }

    public function admin_login()
    {
        return view('admin.login');
    }

    public function admin_login_post(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'password'          => 'min:8|max:255'
            ]
            ,
            [
                'password.min'              => ':attribute must be at least 8 characters long !',
                'password.max'              => ':attribute must be a maximum of 255 characters long !'
            ]
            ,
            [
                'password'          => 'Password'
            ]
        );

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);;
        }
        else
        {
            $email = $request->email;
            $password = $request->password;
            $remember = $request->remember;
            if(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1], $remember))
            {
                return  redirect()->route('admin.dashboard');
            }
            else
            {
                return  redirect()->back()->with('error', 'Login Unsuccessfully !');                
            }
        }   
    }

    public function admin_logout()
    {
        Auth::logout();
        return redirect()->route('admin_login');
    }
}
