<?php

namespace Instagram;

use Instagram\Post;
use Instagram\Like;
use Instagram\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany('Post');
    }

    public function likes() {
        return $this->hasMany('Like');
    }

    public function comments() {
        return $this->hasMany('Comment');
    }
}
