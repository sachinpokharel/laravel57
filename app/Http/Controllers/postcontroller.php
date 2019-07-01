<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=post::all();
        return view('back.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cats=Category::all();

       // dd($cats);
        return view('back.posts.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|alpha|min:5',
            'status' => 'required|boolean',
            'files' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
           //Handle file upload
        if ($request->hasFile('files')) {
            // Get jst ext
            $extension = $request->file('files')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = time() . '.' . $extension;
            //uplod image
            $file = $request->file('files');
            $destinationPath = public_path('/uploads');
            $file->move($destinationPath, $fileNameToStore);
        } else {
            return redirect()->back()->withInput($request->input())->with('error', 'File Not Selected');
        }
        $posts= new post([
            'title'=>$request->get('title'), //right side is table data name and left side is form name
            'keyword'=>$request->get('keyword'),
            'description'=>$request->get('description'),
            'heading' => $request->get('heading'),
            'shortstory' => $request->get('shortstory'),
            'fullstory' =>$request->get('fullstory'),
            'category_id' => $request->get('category_id'),
            'user_id' => $request->get('user_id'),
            'fimage' => $request->get('fimage'),
            'status'=>$request->get('status'),
            'image'=>$fileNameToStore






        ]);


        $posts->save();
      return redirect('/posts')->with('success', 'post has been added');
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
        $posts = post::find($id);

        return view('back.posts.edit', compact('posts'));
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
        $request->validate([
            'title'=>'required',
            'keyword'=>'required',
            'description'=>'required',
            'heading'=> 'required',
            'shortstory'=> 'required',
            'fullstory'=> 'required',
            'category_id'=> 'required',
            'user_id'=> 'required',
            'fimage'=> 'required',
            'status' => 'required|integer'
          ]);

          $posts = post::find($id);
          $posts->title = $request->get('title');
          $posts->keyword = $request->get('keyword');
          $posts->description = $request->get('description');
          $posts->heaading = $request->get('heading');
          $posts->shortstory = $request->get('shortstory');
          $posts->fullstory = $request->get('fullstory');
          $posts->category_id = $request->get('category_id');
          $posts->user_id = $request->get('user_id');
          $posts->fimage = $request->get('fimage');
          $posts->status = $request->get('status');
          $posts->save();

          return redirect('/post')->with('success', 'post has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = post::find($id);
        $posts->delete();

         return redirect('/posts')->with('success', 'posst has been deleted Successfully');
    }

}
