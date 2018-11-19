<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use App\Tag;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store all the blog posts in it from the database
        $posts = Posts::orderBy('id','desc')->paginate(8);
        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($category)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'title'       => 'required | max:255',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'        => 'required',
            'featured_image' => 'sometimes|image|size:5000'
        ]);

        // store on the database

        $post = new Posts;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        // Save Our Image
        if ($request->hasFile('featured_image')) {

            $image = $request->file('featured_image');

            $filename = time().".".$image->getClientOriginalExtension();

            $location = public_path('images/'.$filename);

            Image::make($image)->resize(800, 400)->save($location);


            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'Successfully Saved');

        // redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database and save as variable
        $post = Posts::find($id);
        $categories = Category::pluck('name','id');
        $tags = Tag::pluck('name','id');

        // return the view and passs in the variable we previously created
        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
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
        // Validate The Data
        $post = Posts::find($id);
        
            $this->validate($request, [
                'title'=>'required|max:255', 
                'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
                'category_id'=>'required|integer',
                'body'=>'required',
                'featured_image'=>'image'
            ]);

        // Save The Data To The Database
        $post = Posts::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {
            // Add The New Photo
            $image = $request->file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800, 400)->save($location);
            $oldFilename = $post->image;
            // Update The Database
            $post->image = $filename;
            // Delete The Old Photo
            Storage::delete($oldFilename);
        }

        $post->save();

        $tags = $request->input('tags', []);
        $post->tags()->sync($tags, true);

        // Set Flash Data With Success Message
        Session::flash('success', 'This Post Save Successfully');

        // Redirect With Flash Data To posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::find($id);

        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success','This Post Deleted Successfully');

        return redirect()->route('posts.index');
    }
}
