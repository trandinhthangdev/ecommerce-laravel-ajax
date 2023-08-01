<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsComment;
class NewsCommentController extends Controller
{
    public function index()
    {
    	$news_comment = NewsComment::orderBy('id', 'DESC')->paginate(5);
    	return view('admin.pages.news-comment', ['news_comment' => $news_comment]);
    }	
}

