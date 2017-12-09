<?php

namespace BlogMK;

use Illuminate\Database\Eloquent\Model;

Class Article extends Model {
    protected $fillable [
        'ArticleTitle', 'articleText', 'articleAuthor_id'
    ];

    public function author() {
        return $this->belongsTo('BlogMK\Author');
    }
}