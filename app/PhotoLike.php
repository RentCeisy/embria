<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoLike extends Model
{
    protected $table = 'photo_likes';
    protected $fillable = [
        'user_id',
        'photo_id'
    ];
}
