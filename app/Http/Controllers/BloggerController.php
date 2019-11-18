<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use App\Blogger;
use App\Game;
class BloggerController extends Controller
{
    public function allPosts(){
      $blogger = Blogger::orderBy('id', 'desc')->get();
      return view('admin.blogger.index')->with('blogger', $blogger)
                                        ->with('panelTitle', 'Wszystkie posty');
    }

    public function activated($id){
      $blogger = Blogger::find($id);
      if($blogger->active==0){
        $blogger->active = 1;
        Session::flash('success', 'Wpis został aktywowany');
      } else {
        $blogger->active = 0;
        Session::flash('information', 'Wpis został dezaktywowany');
      }
      $blogger->save();
      return redirect()->back();
    }

    public function create(){
      if(Auth::user()->bloger == 0 && Auth::user()->admin == 0 && Auth::user()->moderator == 0){
        Session::flash('error', 'Nie masz uprawnień do przeglądania tej strony');
        return redirect()->back();
      }

      return view('blogger.create')->with('panelTitle', 'Utwórz nowy wpis');
    }
    public function store(Request $request){
      if(Auth::user()->bloger == 0 && Auth::user()->admin == 0 && Auth::user()->moderator == 0){
        Session::flash('error', 'Nie masz uprawnień do przeglądania tej strony');
        return redirect()->back();
      }
      $request->validate([
        'title' => 'required|string|between:5,45',
        'description' => 'required|string|between:100,2000',
        'website' => 'nullable|pstring|url',
        'file' => 'required'
      ]);
      $gallery_path = 'uploads/post';
      $image = $request->file('file');
      $name = time() .  $image->getClientOriginalName();
      $image->move($gallery_path, $name);
      $img = Image::make($gallery_path . '/' .$name);
      $img->resize(null, 200, function($constraint){
        $constraint->aspectRatio();
      })->save($gallery_path . '/' . $name);

      Blogger::create([
        'title' => $request->title,
        'description' => $request->description,
        'website' => $request->website,
        'user_id' => Auth::user()->id,
        'cover' => $name
      ]);

      Session::flash('success', 'Wpis został dodany');
      return redirect()->back();
    }

    public function createReview($id){
      $game = Game::find($id);
      if(!$game){
        return view('frontend.messages.error')->with('error', 'Ta gra nie istnieje');
      }

      if(Auth::user()->bloger == 0 && Auth::user()->admin == 0 && Auth::user()->moderator == 0){
        Session::flash('error', 'Nie masz uprawnień do przeglądania tej strony');
        return redirect()->back();
      }

      return view('blogger.create')->with('id', $id)
                                   ->with('game', $game)
                                   ->with('panelTitle', 'Utwórz nową recenzję');
    }


    public function storeReview(Request $request, $id){
      $game = Game::find($id);
      if(Auth::user()->bloger == 0 && Auth::user()->admin == 0 && Auth::user()->moderator == 0){
        Session::flash('error', 'Nie masz uprawnień do przeglądania tej strony');
        return redirect()->back();
      }
      $request->validate([
        'title' => 'required|string|between:5,45',
        'description' => 'required|string|between:100,2000',
        'website' => 'required|string|url',
        'file' => 'required'
      ]);
      $gallery_path = 'uploads/post';
      $image = $request->file('file');
      $name = time() .  $image->getClientOriginalName();
      $image->move($gallery_path, $name);
      $img = Image::make($gallery_path . '/' .$name);
      $img->resize(null, 200, function($constraint){
        $constraint->aspectRatio();
      })->save($gallery_path . '/' . $name);

      Blogger::create([
        'title' => $request->title,
        'description' => $request->description,
        'website' => $request->website,
        'user_id' => Auth::user()->id,
        'game_id' => $id,
        'cover' => $name
      ]);

      Session::flash('success', 'Wpis został dodany');
      return redirect()->back();
}
}
