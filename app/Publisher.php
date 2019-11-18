<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = ['name', 'logo', 'slug'];

    public function games(){
      return $this->hasMany('App\Game');
    }
}
