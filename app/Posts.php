<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // protected $table = 'posts';
    // protected $fillable = [ 'title', 'body', 'created_at', 'updated_at',];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
