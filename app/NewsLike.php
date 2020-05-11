<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLike extends Model
{
    protected $table = 'news_likes';
    protected $fillable = [
        'user_id',
        'news_id'
    ];
}
