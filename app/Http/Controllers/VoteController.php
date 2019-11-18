<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Vote;

class VoteController extends Controller
{
  public function saveVote($game, $vote)
  {
    $expert = 0;
    $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game)->count();
    if($voted > 0){
      Session::flash('error', 'Już głosowałeś!');
      return redirect()->back();
      exit;
    }

    if($vote < 1 || $vote > 5){
      Session::flash('error', 'Niewłaścia ocena!');
      return redirect()->back();
      exit;
    }

      if(Auth::user()->bloger == 1 || Auth::user()->admin == 1 || Auth::user()->moderator == 1){
        $expert = 1;
      }
      Vote::create([
        'user_id' => Auth::user()->id,
        'game_id' => $game,
        'vote' => $vote,
        'expert' => $expert
      ]);
  }

  public function updateVote($game, $vote)
  {
    $expert = 0;
    $voted = Vote::where('user_id', Auth::user()->id)->where('game_id', $game)->count();
    if($voted != 1){
      Session::flash('error', 'Nie można zaktualizować Twojego głosu!');
      return redirect()->back();
      exit;
    }
    if($vote < 1 || $vote > 5){
      Session::flash('error', 'Niewłaścia ocena!');
      return redirect()->back();
      exit;
    }
    $game = Vote::where('user_id', Auth::user()->id)->where('game_id', $game)->first();
    if(Auth::user()->bloger == 1 || Auth::user()->admin == 1 || Auth::user()->moderator == 1){
      $expert = 1;
    }
    $game->vote = $vote;
    $game->expert = $expert;
    $game->Save();
  }

}
