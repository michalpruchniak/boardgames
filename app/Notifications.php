<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = ['seen', 'user_id', 'content', 'url', 'type', 'comment_id'];
}
