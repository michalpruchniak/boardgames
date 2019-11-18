<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Input;
use Image;
use Session;
use App\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Preferences(){
      return view('panel.preferences.index')->with('panelTitle', 'Preferencje');
    }

    public function AvatarStore(Request $request){
      $this->Validate($request, [
                'file' => 'required|image|dimensions:max_width:200,max_height:200',
        ]);
      $userid = Auth::user()->id;
      if(Input::file('file')){
        $gallery_path = 'uploads/avatars';
      $image = $request->file('file');
      $name = time() .  $image->getClientOriginalName();
      $image->move($gallery_path, $name);
      $img = Image::make($gallery_path . '/' .$name);
        $img->resize(100, 100)->save($gallery_path . '/' . $name);
        $user = User::find($userid);
        $user->avatar = $name;
        $user->save();
  }

  Session::flash('success', 'Avatar został zmieniony');
  return redirect()->back();
  }

  public function DelAvatar(){
    $userid = Auth::user()->id;
    $user = User::find($userid);
    $user->avatar = null;
    $user->save();

    Session::flash('information', 'Avatar został usunięty');
    return redirect()->back();

  }

  public function checkGender(Request $request){
    $this->Validate($request, [
        'gender' => 'required|integer|min:0|max:2'
    ]);
    $userid = Auth::user()->id;
    $user = User::find($userid);
    $user->gender = $request->gender;
    $user->save();
    Session::flash('success', 'Płeć została wybrana');
    return redirect()->back();

  }
  public function checkDOB(Request $request){
    $this->Validate($request, [
        'dob' => 'nullable|date|date_format:Y-m-d',
        'dobvisible' => 'boolean'
    ]);
    $userid = Auth::user()->id;
    $user = User::find($userid);
    $user->DOB = $request->dob;
    $user->dobvisible = $request->dobvisible;
    $user->save();
    Session::flash('success', 'Data urodzenia została zmieniona');
    return redirect()->back();

  }

    public function ChangePasswword(){
      return view('panel.password.update')->with('panelTitle', 'Zmień hasło');
    }
    public function UpdatePasswword(Request $request){
      if(!$request){
        return view('message.error')->with('error', 'Nie wysłano żadnych danych');
        exit;
      }
      $this->Validate($request, [
           'password' => 'required|min:5|max:36',
           'repassword' => 'required|min:5|max:36|same:password',
       ]);
       $user = User::find(Auth::user()->id);
       $user->password = bcrypt($request->password);
       $user->save();
       Session::flash("success", "Hasło zostało zmienione");
       return redirect()->back();
    }

    public function ChangeListLayout(Request $request){
      $this->Validate($request, [
                'layout' => 'required|integer|between:1,1',
                'layoutvisible' => 'boolean'
        ]);
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->mylist = $request->layout;
        $user->layoutvisible = $request->layoutvisible;
        $user->save();
        Session::flash('success', 'Layout został zmieniony');
        return redirect()->back();
    }
    public function addDescription(Request $request){
      $this->Validate($request, [
                'description' => 'nullable|string|between:10,1800'
        ]);
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $user->description = $request->description;
        $user->save();
        Session::flash('success', 'Opis został zmieniony');
        return redirect()->back();
    }
}
