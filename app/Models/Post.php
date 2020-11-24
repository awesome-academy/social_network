<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'caption',
        'total_like',
    ];

    public function images()
    {
        return $this->hasMany(Image::class,'post_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function hashtags()      
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function activities()
    {
        return $this->morphToMany(Activity::class,'actable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
