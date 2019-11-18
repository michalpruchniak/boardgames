<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'game_id', 'comment'];
    public function game(){
        return $this->belongsTo('App\Game');
    }
    public function response(){
        return $this->hasMany('App\Comment');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
