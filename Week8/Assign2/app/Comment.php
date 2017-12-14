<?php

namespace Instagram;

use Instagram\User;
use Instagram\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'user_id', 'post_id'
    ];

    public function user() {
        return $this->blongsTo('User');
    }

    public function post() {
        return $this->blongsTo('Post');
    }
}
}
