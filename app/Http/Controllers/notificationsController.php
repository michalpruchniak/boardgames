<?php

namespace App\Http\Controllers;
use Auth;
use App\Notifications;
use App\Comment;

use Illuminate\Http\Request;

class notificationsController extends Controller
{
    public function goToComment($id, $commentid){
      $notification = Notifications::find($id);
      if($notification->user_id != Auth::user()->id){
        return view('frontend.messages.error')->with('error', 'Nie masz uprawnień do przeglądania tej strony.');
      }
      $comment = Comment::find($commentid);
      if($comment->user_id != Auth::user()->id){
        return view('frontend.messages.error')->with('error', 'Nie masz uprawnień do przeglądania tej strony.');
      }
      $notification->seen = 1;
      $notification->save();
      return redirect(route('frontend.comment', ['id' => $commentid]));
    }
}
