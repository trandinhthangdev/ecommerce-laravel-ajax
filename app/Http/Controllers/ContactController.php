<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
    	$contact = Contact::orderBy('id', 'DESC')->paginate(5);
    	return view('admin.pages.contact', ['contact' => $contact]);
    }
}
