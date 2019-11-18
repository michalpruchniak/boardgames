<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defaultArticles extends Model
{
    protected $fillable = ['title', 'description', 'slug'];
}
