<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
  protected $fillable = ['name', 'photo', 'slug'];

  public function games(){
        return $this->belongsToMany('App\Game');
    }
}
