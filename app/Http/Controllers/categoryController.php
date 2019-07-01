<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cats=category::all();
        return view('back.categorys.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.categorys.create');
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
            'name'=>'required|alpha|min:5',
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
        $cats= new Category([
            'name'=>$request->get('name'), //right side is table data name and left side is form name
            'description'=>$request->get('description'),
            'status'=>$request->get('status'),
            'image'=>$fileNameToStore

        ]);


        $cats->save();
      return redirect('/cats')->with('success', 'Category has been added');
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
        $cats = Category::find($id);

        return view('back.categorys.edit', compact('cats'));
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
            'name'=>'required',
            'description'=> 'required',
            'status' => 'required|integer'
          ]);

          $cats = Category::find($id);
          $cats->name = $request->get('name');
          $cats->description = $request->get('description');
          $cats->status = $request->get('status');
          $cats->save();

          return redirect('/cats')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $cats = Category::find($id);
    $cats->delete();

     return redirect('/cats')->with('success', 'Category has been deleted Successfully');
    }
}
