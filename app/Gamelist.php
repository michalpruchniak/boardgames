<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamelist extends Model
{
    protected $fillable = ['game_id', 'user_id', 'list'];

    public function Game(){
      return $this->belongsTo('App\Game');
    }
    public function User(){
      return $this->belongsTo('App\User');
    }
}
