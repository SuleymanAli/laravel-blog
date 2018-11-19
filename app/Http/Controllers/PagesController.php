<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Mail;
use Session;

class PagesController extends Controller
{
    public function index(){
        $posts = Posts::select('*')->orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.welcome')->withPosts($posts);
    }

    public function about(){
        return view('pages.about');
    }

    public function getContact(){
        return view('pages.contact');
    }

    public function postContact(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'subject'=>'min:3',
            'message'=>'min:10'
        ]);

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('me@suleymanaliyev.tech');
            $message->subject($data['subject']);
        });

        Session::flash('success','Your Email Was Sent');

        return redirect('/');
    }
}
