<?php

namespace App\Http\Controllers;
use App\Game;
use App\Publisher;
use App\Designer;
use App\Artist;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function callGames(Request $request){
      $games = Game::where('title', 'like',  '%'. $request->title . '%')->limit(3)->get();

      echo json_encode($games);
    }

    public function callPublishers(Request $request){
      $publisher = Publisher::where('name', 'like',  '%'. $request->name . '%')->get();

      echo json_encode($publisher);
    }

    public function callDesigners(Request $request){
      $designers = Designer::where('name', 'like',  '%'. $request->name . '%')->get();

      echo json_encode($designers);
    }

    public function callArtists(Request $request){
      $artist = Artist::where('name', 'like',  '%'. $request->name . '%')->get();

      echo json_encode($artist);
    }

}
