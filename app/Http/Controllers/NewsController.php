<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(5);
        return view('admin.pages.news', ['news'=>$news]);
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
                'title' => 'unique:news,title|min:10|max:255',
            ]
            ,
            [
                'title.unique' => ':attribute already exists in the system !',
                'title.min' => ':attribute must have at least 10 characters !',
                'title.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'title' => 'News'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $slug = utf8tourl($request->title);
            $image_file = $request->image;
            $extenstion_image_file = $image_file->getClientOriginalExtension();
            $name_image_file = time() . '-' . $slug . '.' . $extenstion_image_file;
            $image_file->move('assets/uploads/news/image', $name_image_file);
            $data_news = $request->all();
            $data_news['image'] = $name_image_file;
            $data_news['slug'] = $slug;
            News::create($data_news);
            return response()->json(['res_type' => 'success', 'response' => 'Created News Successfully !']);
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
        $news = News::find($id);
        return response()->json($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return response()->json($news);
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
                'title' => 'unique:news,title,'.$id.'|min:3|max:255',
            ]
            ,
            [
                'title.unique' => ':attribute already exists in the system !',
                'title.min' => ':attribute must have at least 3 characters !',
                'title.max' => ':attribute must have at most 255 characters !'
            ]
            ,
            [
                'title' => 'News'
            ]
        );

        if($validator->fails()) 
        {
            return response()->json(['res_type' => 'error', 'response' => $validator->errors()]);
        }
        else
        {
            $news = News::find($id);
            $old_image = $news->image;
            $slug = utf8tourl($request->title);
            if($request->hasFile('image'))
            {
                $image_file = $request->image;
                $extenstion_image_file = $image_file->getClientOriginalExtension();
                $name_image_file = time() . '-' . $slug . '.' . $extenstion_image_file;
                if(file_exists('assets/uploads/news/image/' . $old_image))
                {
                    unlink('assets/uploads/news/image/' . $old_image);
                }
                $image_file->move('assets/uploads/news/image', $name_image_file);
                $data_news = $request->all();
                $data_news['image'] = $name_image_file; 
            }
            else 
            {
                $data_news = $request->all();
            }
            $data_news['slug'] = $slug;
            $news->update($data_news);
            return response()->json(['res_type' => 'success', 'response' => 'Updated News Successfully !']);
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
        /* Delete news */
        $news = News::find($id);
        $old_image = $news->image;
        $news->delete();
        if(file_exists('assets/uploads/news/image/' . $old_image))
        {
            unlink('assets/uploads/news/image/' . $old_image);
        }
   
        return response()->json(['res_type' => 'success', 'response' => 'Deleted News Successfully !']);
    }
}
