<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductComment;

class ProductCommentController extends Controller
{
    public function index()
    {
    	$product_comment = ProductComment::orderBy('id', 'DESC')->paginate(5);
    	return view('admin.pages.product-comment', ['product_comment' => $product_comment]);
    }	
}
