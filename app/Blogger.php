<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    protected $fillable = ['title', 'description', 'website', 'active', 'user_id', 'game_id', 'cover'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
