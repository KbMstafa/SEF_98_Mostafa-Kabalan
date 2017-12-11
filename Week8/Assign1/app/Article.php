<?php

namespace BlogMK;

use Illuminate\Database\Eloquent\Model;

Class Article extends Model {
    protected $fillable = [
        'article_title', 'article_text', 'article_author_id'
    ];

    public function author() {
        return $this->belongsTo('BlogMK\User', 'article_author_id');
    }
}