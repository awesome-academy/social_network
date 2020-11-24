<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'description',
        'fullname',
        'status',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class,'user_id','id');
    }

    public function roles()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function follower()
    {
        return $this->belongsToMany(User::class,'follows','user_id','follow_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class,'follows','follow_id','user_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
