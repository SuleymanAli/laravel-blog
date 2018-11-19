<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Posts;
use Session;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'comment'=>'required|min:5|max:2000'
        ]);

        $post = Posts::find($post_id);

        $comment = new Comment;

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->posts()->associate($post);

        $comment->save();

        Session::flash('success','Your Comment Was Added');

        return redirect()->route('blog.single', $post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, [
            'comment'=>'required',
        ]);

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment Updated');

        return redirect()->route('posts.show', $comment->posts->id); 
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $post_id = $comment->posts->id;

        $comment->delete();

        Session::flash('success','Deleted Comment');

        return redirect()->route('posts.show', $post_id);        
    }
}
