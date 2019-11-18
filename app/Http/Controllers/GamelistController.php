<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Game;
use App\Gamelist;

class GamelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function ihave($id){
       if(!isset(Auth::user()->id)){
         return redirect('/login');
         exit;
       }

       $user = Auth::user()->id;
       $game = Game::find($id);

       if(!$game){
         Session::flash('error', 'Ta gra nie istnieje');
         return redirect()->back();

       }
       $isset = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->count();
       if($isset == 0){
         Gamelist::create([
           'user_id' => $user,
           'game_id' => $game->id,
           'list' => 1
         ]);
         Session::flash('success', 'Gra została dodana do listy "posiadam"');
       } else {
         $gra = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 1)->first();
         $gra->forceDelete();
         Session::flash('information', 'Gra została usunięta z listy "posiadam"');

       }
       return redirect()->back();
     }

     public function iplayed($id){
       if(!isset(Auth::user()->id)){
         return redirect('/login');
         exit;
       }

       $user = Auth::user()->id;
       $game = Game::find($id);

       if(!$game){
         Session::flash('error', 'Ta gra nie istnieje');
         return redirect()->back();

       }
       $isset = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->count();
       if($isset == 0){
         Gamelist::create([
           'user_id' => $user,
           'game_id' => $game->id,
           'list' => 2
         ]);
         Session::flash('success', 'Gra została dodana do listy "posiadam"');
       } else {
         $gra = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 2)->first();
         $gra->forceDelete();
         Session::flash('information', 'Gra została usunięta z listy "posiadam"');
       }
       return redirect()->back();
     }

     public function iwtb($id){
       if(!isset(Auth::user()->id)){
         return redirect('/login');
         exit;
       }

       $user = Auth::user()->id;
       $game = Game::find($id);

       if(!$game){
         Session::flash('error', 'Ta gra nie istnieje');
         return redirect()->back();

       }
       $isset = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->count();
       if($isset == 0){
         Gamelist::create([
           'user_id' => $user,
           'game_id' => $game->id,
           'list' => 3
         ]);
         Session::flash('success', 'Gra została dodana do listy "posiadam"');
       } else {
         $gra = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 3)->first();
         $gra->forceDelete();
         Session::flash('information', 'Gra została usunięta z listy "posiadam"');
       }
       return redirect()->back();
     }

     public function favorite($id){
       if(!isset(Auth::user()->id)){
         return redirect('/login');
         exit;
       }

       $user = Auth::user()->id;
       $game = Game::find($id);

       if(!$game){
         Session::flash('error', 'Ta gra nie istnieje');
         return redirect()->back();

       }
       $isset = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->count();
       if($isset == 0){
         Gamelist::create([
           'user_id' => $user,
           'game_id' => $game->id,
           'list' => 4
         ]);
         Session::flash('success', 'Gra została dodana do listy "posiadam"');
       } else {
         $gra = Gamelist::where('user_id', $user)->where('game_id', $game->id)->where('list', 4)->first();
         $gra->forceDelete();
         Session::flash('information', 'Gra została usunięta z listy "posiadam"');
       }
       return redirect()->back();
     }
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
