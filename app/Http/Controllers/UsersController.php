<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::orderBy('name', 'asc')->paginate(40);
      return view('admin.users.index')->with('elements', $users)
                                      ->with('panelTitle', 'Wszyscy użytkownicy');
    }

    public function banned($id){
      $user = User::find($id);

      if(!$user){
        Session::flash('error', 'Ten user nie istnieje');
        return redirect()->back();
      }

      if($user->id == Auth::user()->id){
        Session::flash('error', 'Nie można zbanować samego siebie');
        return redirect()->back();
      }

      if($user->admin == 1){
        Session::flash('error', 'Nie można zbanować administratora');
        return redirect()->back();
      }

      if($user->moderator == 1 && !Auth::user()->admin == 1){
        Session::flash('error', 'Tylko administrator może zbanować moderatora');
        return redirect()->back();
      }
      if($user->ban == 0){
        $user->ban = 1;
        Session::flash('information', 'Użytkownik został zbanowany');
      } else {
        $user->ban = 0;
        Session::flash('success', 'Ban zaostał zdjęty');
      }
      $user->save();

      return redirect()->back();
    }

    public function makeModerator($id){
      if(Auth::user()->admin == 0){
        Session::flash('error', 'Tylko administrator może dodawać moderatorów');
        return redirect()->back();
      }
      $user = User::find($id);
      if($user->admin == 1){
        Session::flash('error', 'Admin zawsze posiada uprawnienia moderatora');
        return redirect()->back();
      }

      if($user->moderator == 0){
        $user->moderator = 1;
        $user->save();
        Session::flash('success', 'Ten użytkowwnik został moderatorem');
        return redirect()->back();
      } else {
        $user->moderator = 0;
        $user->save();
        Session::flash('information', 'Ten użytkonik przestał być moderatorem');
        return redirect()->back();
      }
    }
    public function makeBlogger($id){
      if(Auth::user()->admin == 0){
        Session::flash('error', 'Tylko administrator może dodawać bloggerów');
        return redirect()->back();
      }
      $user = User::find($id);
      if($user->admin == 1){
        Session::flash('error', 'Admin zawsze posiada uprawnienia bloggera');
        return redirect()->back();
      }

      if($user->bloger == 0){
        $user->bloger = 1;
        $user->save();
        Session::flash('success', 'Ten użytkowwnik został bloggerem');
        return redirect()->back();
      } else {
        $user->bloger = 0;
        $user->save();
        Session::flash('information', 'Ten użytkonik przestał być bloggerem');
        return redirect()->back();
      }
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
        //
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
