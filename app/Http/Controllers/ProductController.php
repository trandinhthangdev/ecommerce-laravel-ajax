<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\ProductSlider;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_slug, $category_id, $brand_slug, $brand_id)
    {
        $product = Product::where('category_id', $category_id)->where('brand_id', $brand_id)->paginate(5);
        $category = Category::find($category_id);
        $brand = Brand::find($brand_id);
        return view('admin.pages.product', ['product' => $product,'brand' => $brand, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($category_id, $brand_id, Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'unique:products,name|min:3|max:255',
            ]
            ,
            [
                'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Product'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $slug = utf8tourl($request->name);

            /* thumbnail */
            $thumbnail_file = $request->thumbnail;
            $extenstion_thumbnail_file = $thumbnail_file->getClientOriginalExtension();
            $name_thumbnail_file = time() . '-' . $slug . '.' . $extenstion_thumbnail_file;
            $thumbnail_file->move('assets/uploads/products/thumbnail', $name_thumbnail_file);


            $data_product = $request->all();
            $data_product['thumbnail'] = $name_thumbnail_file;
            $data_product['slug'] = $slug;
            $data_product['category_id'] = $category_id;
            $data_product['brand_id'] = $brand_id;
            unset($data_product['sliders']);
            $product_id = Product::create($data_product)->id;
            
            /* sliders */
            $sliders = $request->sliders;
            $index = 1;
            foreach ($sliders as $slider) {
	            $extenstion_slider = $slider->getClientOriginalExtension();
	            $name_slider = time() . '-' . $slug . '-slider-'. $index . '.' . $extenstion_slider;
	            $slider->move('assets/uploads/products/sliders', $name_slider);
	            $data_product_slider = [
	            	'product_id' => $product_id,
	            	'image' => $name_slider
	            ];
	            ProductSlider::create($data_product_slider);
	            $index ++;
            }

            return response()->json(['res_type' => 'success', 'response' => 'Created Product Successfully !']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $sliders = ProductSlider::where('product_id', $id)->get();
        return response()->json([$product, $sliders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sliders = ProductSlider::where('product_id', $id)->get();
        return response()->json([$product, $sliders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$product = Product::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'unique:brands,name,'.$id.'|min:3|max:255',
                
            ]
            ,
            [
            	'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Product'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $old_thumbnail = $product->thumbnail;
            $slug = utf8tourl($request->name);

            if($request->hasFile('thumbnail'))
            {
                /* thumbnail */
	            $thumbnail_file = $request->thumbnail;
	            $extenstion_thumbnail_file = $thumbnail_file->getClientOriginalExtension();
	            $name_thumbnail_file = time() . '-' . $slug . '.' . $extenstion_thumbnail_file;
	            
                if(file_exists('assets/uploads/products/thumbnail/' . $old_thumbnail))
                {
                    unlink('assets/uploads/products/thumbnail/' . $old_thumbnail);
                }
	            $thumbnail_file->move('assets/uploads/products/thumbnail', $name_thumbnail_file);


	            $data_product = $request->all();
	            $data_product['thumbnail'] = $name_thumbnail_file;
	            $data_product['slug'] = $slug;

	            if($request->hasFile('sliders'))
	            {
	            	unset($data_product['sliders']);
	            	$product->update($data_product);

	            	/* sliders */
		            $sliders = $request->sliders;

		            /* Delete product_sliders */
		            $product_sliders = ProductSlider::where('product_id', $id)->get();
		            foreach ($product_sliders as $slider) {
		            	$old_slider = $slider->image;
                        if(file_exists('assets/uploads/products/sliders/' . $old_slider))
                        {
                            unlink('assets/uploads/products/sliders/' . $old_slider);
                        }
		            	$slider->delete();
		            }

		            /* Create product_sliders */
		            $index = 1;
		            foreach ($sliders as $slider) {
			            $extenstion_slider = $slider->getClientOriginalExtension();
			            $name_slider = time() . '-' . $slug . '-slider-'. $index . '.' . $extenstion_slider;
			            $slider->move('assets/uploads/products/sliders', $name_slider);
			            $data_product_slider = [
			            	'product_id' => $id,
			            	'image' => $name_slider
			            ];
			            ProductSlider::create($data_product_slider);
			            $index ++;
		            }
	            }
	            else
	            {
	            	$product->update($data_product);
	            }

	            
	        }
            else 
            {
            	$data_product = $request->all();

                if($request->hasFile('sliders'))
	            {
	            	unset($data_product['sliders']);
	            	$product->update($data_product);

	            	/* sliders */
		            $sliders = $request->sliders;

		            /* Delete product_sliders */
		            $product_sliders = ProductSlider::where('product_id', $id)->get();
		            foreach ($product_sliders as $slider) {
		            	$old_slider = $slider->image;
                        if(file_exists('assets/uploads/products/sliders/' . $old_slider))
                        {
                            unlink('assets/uploads/products/sliders/' . $old_slider);
                        }
		            	$slider->delete();
		            }

		            /* Create product_sliders */
		            $index = 1;
		            foreach ($sliders as $slider) {
			            $extenstion_slider = $slider->getClientOriginalExtension();
			            $name_slider = time() . '-' . $slug . '-slider-'. $index . '.' . $extenstion_slider;
			            $slider->move('assets/uploads/products/sliders', $name_slider);
			            $data_product_slider = [
			            	'product_id' => $id,
			            	'image' => $name_slider
			            ];
			            ProductSlider::create($data_product_slider);
			            $index ++;
		            }
	            }
	            else
	            {
	            	$product->update($data_product);
	            }
            }

            return response()->json(['res_type' => 'success', 'response' => 'Updated Product Successfully !']);
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
        /* Delete sliders file by product */
        $product_sliders = ProductSlider::where('product_id', $id)->get();
        foreach ($product_sliders as $slider) {
            if(file_exists('assets/uploads/products/sliders/' . $slider->image))
            {
                unlink('assets/uploads/products/sliders/' . $slider->image);
            }
        }
        
        $product = Product::find($id);
        $old_thumbnail = $product->thumbnail;
        $product->delete();
        if(file_exists('assets/uploads/products/thumbnail/' . $old_thumbnail))
        {
            unlink('assets/uploads/products/thumbnail/' . $old_thumbnail);
        }
        return response()->json(['res_type' => 'success', 'response' => 'Deleted Category Successfully !']);
    }



}
