<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime: d M, yy',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo', 'news_id', 'id');
    }

    public function photo()
    {
        return $this->hasOne('App\Photo', 'news_id', 'id')->latest();
    }

    public function likes()
    {
        return $this->hasMany('App\NewsLike', 'news_id', 'id');
    }

    public function like()
    {
        return $this->hasOne('App\NewsLike', 'news_id', 'id');
    }
}
