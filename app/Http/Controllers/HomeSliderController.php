<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeSlider;
use Validator;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home_slider = HomeSlider::paginate(5);
        return view('admin.pages.slider',['home_slider' => $home_slider]);
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
        $image_file = $request->image;
        $extenstion_image_file = $image_file->getClientOriginalExtension();
        $name_image_file = time() . '.' . $extenstion_image_file;
        $image_file->move('assets/uploads/sliders', $name_image_file);
        $data_home_slider = $request->all();
        $data_home_slider['image'] = $name_image_file;

        HomeSlider::create($data_home_slider);
        return response()->json(['res_type' => 'success', 'response' => 'Created Category Successfully !']);
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
        $home_slider = HomeSlider::find($id);
        return response()->json($home_slider);
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
        $home_slider = HomeSlider::find($id);
        $old_image = $home_slider->image;
        if($request->hasFile('image'))
        {
            $image_file = $request->image;
            $extenstion_image_file = $image_file->getClientOriginalExtension();
            $name_image_file = time() . '.' . $extenstion_image_file;
            unlink('assets/uploads/sliders/' . $old_image);
            $image_file->move('assets/uploads/sliders', $name_image_file);
            $data_home_slider = $request->all();
            $data_home_slider['image'] = $name_image_file; 
        }
        else 
        {
            $data_home_slider = $request->all();
        }
        $home_slider->update($data_home_slider);
        return response()->json(['res_type' => 'success', 'response' => 'Updated Slider Successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Delete slider */
        $home_slider = HomeSlider::find($id);
        $old_image = $home_slider->image;
        $home_slider->delete();

        unlink('assets/uploads/sliders/' . $old_image);
        
        return response()->json(['res_type' => 'success', 'response' => 'Deleted Slider Successfully !']);
    }
}
