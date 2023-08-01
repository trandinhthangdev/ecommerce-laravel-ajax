<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $brand = Category::where('category_id', $category_id)->paginate(5);
        return view('admin.pages.brand', ['brand' => $brand]);
    }
}
