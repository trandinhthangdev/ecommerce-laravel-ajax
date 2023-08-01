<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\ProductSlider;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(5);
        return view('admin.pages.category', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'unique:categories,name|min:3|max:255',
            ]
            ,
            [
                'name.unique' => ':attribute already exists in the system !',
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Category'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $slug = utf8tourl($request->name);
            $image_file = $request->image;
            $extenstion_image_file = $image_file->getClientOriginalExtension();
            $name_image_file = time() . '-' . $slug . '.' . $extenstion_image_file;
            $image_file->move('assets/uploads/categories/image', $name_image_file);
            $data_category = $request->all();
            $data_category['image'] = $name_image_file;
            $data_category['slug'] = $slug;
            Category::create($data_category);
            return response()->json(['res_type' => 'success', 'response' => 'Created Category Successfully !']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
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
        $validator = Validator::make($request->all(),
            [
                'name' => 'unique:categories,name,'.$id.'min:3|max:255',
            ]
            ,
            [
                'name.min' => ':attribute must have at least 3 characters !',
                'name.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'name' => 'Category'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $category = Category::find($id);
            $old_image = $category->image;
            $slug = utf8tourl($request->name);
            if($request->hasFile('image'))
            {
                $image_file = $request->image;
                $extenstion_image_file = $image_file->getClientOriginalExtension();
                $name_image_file = time() . '-' . $slug . '.' . $extenstion_image_file;
                unlink('assets/uploads/categories/image/' . $old_image);
                $image_file->move('assets/uploads/categories/image', $name_image_file);
                $data_category = $request->all();
                $data_category['image'] = $name_image_file; 
            }
            else 
            {
                $data_category = $request->all();
            }
            $data_category['slug'] = $slug;
            $category->update($data_category);
            return response()->json(['res_type' => 'success', 'response' => 'Updated Category Successfully !']);
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
        /* Delete product file by category */
        $products = Product::where('category_id', $id)->get();
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
        /* Delete category */
        $category = Category::find($id);
        $old_image = $category->image;
        $category->delete();

        unlink('assets/uploads/categories/image/' . $old_image);
        
        return response()->json(['res_type' => 'success', 'response' => 'Deleted Category Successfully !']);
    }
}
