<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleOfBoards extends Model
{
    protected $fillable = ['name', 'photo', 'slug'];
}
