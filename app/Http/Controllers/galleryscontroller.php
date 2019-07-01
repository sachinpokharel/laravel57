Skip to content

Search or jump to…

Pull requests
Issues
Marketplace
Explore

@sachinpokharel
 The password you provided is weak and can be easily guessed. To increase your security, please change your password as soon as possible.

Read our documentation on safer password practices.

0
0 0 WilcyWilson/SAMB-Laravel
 Code  Issues 0  Pull requests 0  Projects 0  Wiki  Security  Insights
SAMB-Laravel/app/Http/Controllers/GalleryController.php
@WilcyWilson WilcyWilson gallerypost
1ff1895 23 days ago
143 lines (125 sloc)  3.77 KB

<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\gallerys;
class gallerysController extends Controller
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
        $gallerys=gallery::all();
        return view('back.gallerys.index', compact('gallerys'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.gallerys.create');
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
            'gtype'=>'required|integer',
            'description'=>'required|alpha|min:5',
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
        $gallerys= new Gallery([
            'name'=>$request->get('name'), //right side is table data name and left side is form name
            'gtype'=>$request->get('gtype'),
            'description'=>$request->get('description'),
            'status'=>$request->get('status'),
            'image'=>$fileNameToStore

        ]);

        $gallerys->save();
      return redirect('/gallerys')->with('success', 'Gallery has been added');
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
        $gallerys = Gallery::find($id);
        return view('back.Gallerys.edit', compact('gallerys'));
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
            'gtype'=>'required',
            'description'=> 'required',
            'status' => 'required|integer'
          ]);

          $gallerys = Gallery::find($id);
          $gallerys->name = $request->get('name');
          $gallerys->gtype = $request->get('gtype');
          $gallerys->description = $request->get('description');
          $gallerys->status = $request->get('status');
          $gallerys->save();

          return redirect('/gallerys')->with('success', 'Gallery has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $gallerys = Gallery::find($id);
    $gallerys->delete();
     return redirect('/gallerys')->with('success', 'Gallery has been deleted Successfully');
    }
}
