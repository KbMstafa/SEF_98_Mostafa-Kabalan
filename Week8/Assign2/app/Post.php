<?php

namespace Instagram;

use Instagram\User;
use Instagram\Like;
use Instagram\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'caption', 'image_path'
    ];

    public function user() {
        return $this->blongsTo('User');
    }

    public function likes() {
        return $this->hasMany('Like');
    }

    public function comments() {
        return $this->hasMany('Comment');
    }
}
