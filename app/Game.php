<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  protected $fillable = ['title', 'description', 'publisher_id', 'players', 'time', 'age', 'addition', 'game_id', 'cover', 'slug'];
  public function publisher(){
      return $this->belongsTo('App\Publisher');
  }
  public function designers(){
      return $this->belongsToMany('App\Designer');
  }
  public function artist(){
      return $this->belongsToMany('App\Artist');
  }
  public function category(){
      return $this->belongsToMany('App\Category');
  }
  public function comments(){
      return $this->hasMany('App\Comment');
  }
  public function Visitors(){
      return $this->hasMany('App\StatsGame');
  }
}
