<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class BlogController extends Controller
{
    public function getIndex(){
        $posts = Posts::paginate(2);
        
        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug){
        // Fetch From The DB Based On Slug
        $post = Posts::where('slug', '=', $slug)->first();

        // Return The View And Pass In The Post Object
        return view('blog.single')->withPost($post);
    }
}
