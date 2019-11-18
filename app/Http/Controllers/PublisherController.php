<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publisher.create')->with('panelTitle', 'dodaj wydawcę');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Input::file('file')){
          $gallery_path = 'uploads/publishers';
        $image = $request->file('file');
        $name = time() .  $image->getClientOriginalName();
        $image->move($gallery_path, $name);
        $img = Image::make($gallery_path . '/' .$name);
          $img->resize(null, 100, function($constraint){
            $constraint->aspectRatio();
          })->save($gallery_path . '/' . $name);
        Publisher::create([
          'name' => $request->name,
          'logo' => $name,
          'slug' => str_slug($request->name)
        ]);
    } else {
      Publisher::create([
        'name' => $request->name,
        'slug' => str_slug($request->name)
      ]);
    }

    return redirect()->back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
