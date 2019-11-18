<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Session;
use App\PeopleOfBoards;
use App\Designer;
use App\Artist;
use App\Publisher;
use App\Category;
use App\Game;
use App\Comment;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function gameList(){
       $games = Game::orderBy('created_at', 'desc')->get();
       return view('admin.game.list')->with('games', $games);
     }
    public function delComment($id)
    {
         Comment::destroy($id);

        Session::flash('information', 'Komentarz został usunięty');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.create')->with('designer', Designer::all())
                                        ->with('artist', Artist::all())
                                        ->with('publisher', Publisher::all())
                                        ->with('category', Category::all())
                                        ->with('game', Game::all())
                                        ->with('panelTitle', 'dodaj grę');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->Validate($request, [
                'title' => 'required|string|between:3,35',
                'description' => 'required|string|between:5,5200',
                'players' => 'nullable|string',
                'time' => 'nullable|string',
                'age' => 'nullable|integer',
                'publisher' => 'required',
                'category' => 'required',
                'ads' => 'nullable|string|between:10,180',
                'file' => 'required'
        ]);
      if($request->addition == "on"){
        $request->addition = 1;
      } else {
        $request->addition = 0;
      }
      $gallery_path = 'uploads/game';
      $image = $request->file('file');
      $name = time() .  $image->getClientOriginalName();
      $image->move($gallery_path, $name);
      $img = Image::make($gallery_path . '/' .$name);
      $img->resize(null, 200, function($constraint){
        $constraint->aspectRatio();
      })->save($gallery_path . '/' . $name);

      $gameTitle = Game::where('title', $request->title)->count();
      if($gameTitle > 0){
        $slug = str_slug($request->title). '-' .rand(1, 999);
      } else {
        $slug = str_slug($request->title);
      }
      $game = Game::create([
                'title' => $request->title,
                'description' => $request->description,
                'players' => $request->players,
                'time' => $request->time,
                'age' => $request->age,
                'publisher_id' => $request->publisher,
                'addition' => $request->addition,
                'game_id' => $request->game,
                'ads' => $request->ads,
                'cover' => $name,
                'slug' => $slug
              ]);
              if($request->designer){
                $game->Designers()->attach($request->designer);
              }
              if($request->artist){
                $game->Artist()->attach($request->artist);
              }
             $game->Category()->attach($request->category);
       Session::flash('success', 'Gra zstała dodana');
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
      $editgame = Game::find($id);
      return view('admin.game.edit')->with('designer', Designer::all())
                                      ->with('artist', Artist::all())
                                      ->with('publisher', Publisher::all())
                                      ->with('category', Category::all())
                                      ->with('editgame', $editgame)
                                      ->with('game', Game::all())
                                      ->with('panelTitle', 'dodaj grę');
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
        $game = Game::find($id);
        $this->Validate($request, [
                  'title' => 'required|string|between:3,35',
                  'description' => 'required|string|between:5,5200',
                  'players' => 'nullable|string',
                  'time' => 'nullable|string',
                  'age' => 'nullable|integer',
                  'publisher' => 'required',
                  'category' => 'required',
                  'ads' => 'nullable|string|between:10,180',
                  'addtional' => 'nullable|boolean',
                  'game_id' => 'nullable|integer',
                  'file' => 'nullable|image'
          ]);
        if($request->addition == "on"){
          $request->addition = 1;
        } else {
          $request->addition = 0;
        }
        $game->title = $request->title;
        $game->description = $request->description;
        $game->players = $request->players;
        $game->time = $request->time;
        $game->age = $request->age;
        $game->publisher_id = $request->publisher;
        $game->game_id = $request->game;
        $game->ads = $request->ads;
        $game->Designers()->sync($request->designer);
        $game->Artist()->sync($request->artist);
        $game->Category()->sync($request->category);

        if($request->file('file')){
          $gallery_path = 'uploads/game';
          $image = $request->file('file');
          $name = time() .  $image->getClientOriginalName();
          $image->move($gallery_path, $name);
          $img = Image::make($gallery_path . '/' .$name);
          $img->resize(null, 200, function($constraint){
            $constraint->aspectRatio();
          })->save($gallery_path . '/' . $name);

          $game->cover = $name;
        }
        $game->save();
        Session::flash('success', 'Gra została zaktualizowana');
        return redirect()->back();
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
