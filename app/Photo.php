<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'url',
        'news_id'
    ];

    public function news()
    {
        return $this->belongsTo('App\News', 'id', 'news_id');
    }

    public function likes()
    {
        return $this->hasMany('App\PhotoLike', 'photo_id', 'id');
    }

    public function like()
    {
        return $this->hasOne('App\PhotoLike', 'photo_id', 'id');
    }

    public function newsUser()
    {
        return $this->hasOneThrough('App\User', 'App\News', 'id', 'id', 'news_id', 'user_id');
    }
}
