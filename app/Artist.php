<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['name', 'photo', 'slug'];
    public function games(){
          return $this->belongsToMany('App\Game');
      }
}
