<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'post_category', 'post_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
