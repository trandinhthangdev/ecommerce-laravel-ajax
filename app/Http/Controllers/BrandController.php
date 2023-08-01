<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\ProductSlider;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_slug, $category_id)
    {
        $brand = Brand::where('category_id', $category_id)->paginate(5);
        $category = Category::find($category_id);
        return view('admin.pages.brand', ['brand' => $brand, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($category_id, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'unique:brands,name,NULL,id,category_id,'.$category_id.'|min:2|max:255',
            ]
            ,
            [
                'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 2 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Brand'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $slug = utf8tourl($request->name);
            $data_brand = $request->all();
            $data_brand['slug'] = $slug;
            $data_brand['category_id'] = $category_id;
            Brand::create($data_brand);
            return response()->json(['res_type' => 'success', 'response' => 'Created  Brand Successfully !']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($category_id, Request $request, $id)
    {
    	$brand = Brand::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => (($brand->name != $request->name) ? 'unique:brands,name,NULL,id,category_id,'. $category_id .'|min:2|max:255' : 'min:2|max:255'),
                
            ]
            ,
            [
            	'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Brand'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
        	$brand = Brand::find($id);
            $slug = utf8tourl($request->name);
            $data_brand = $request->all();
            $data_brand['slug'] = $slug;
            $brand->update($data_brand);
            return response()->json(['res_type' => 'success', 'response' => 'Updated  Brand Successfully !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Delete product file by brand */
        $products = Product::where('brand_id', $id)->get();
        foreach ($products as $product) {
            /* Delete thumbnail file */
            unlink('assets/uploads/products/thumbnail/' . $product->thumbnail);
            /* Delete sliders file */
            $product_id = $product->id;
            $product_sliders = ProductSlider::where('product_id', $product_id)->get();
            foreach ($product_sliders as $slider) {
                unlink('assets/uploads/products/sliders/' . $slider->image);
            }
        }
        
        $brand = Brand::find($id);
        $brand->delete();
        return response()->json(['res_type' => 'success', 'response' => 'Deleted Category Successfully !']);
    }
}
