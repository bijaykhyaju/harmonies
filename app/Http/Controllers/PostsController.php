<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DB;
use App\Post;

class PostsController extends Controller
{
    public function show($slug){

      //$post = DB::table('posts')->where('slug',$slug)->first(); //before use App\Post;

      //dd($post); //print an array

      $post = Post::where('slug', $slug) -> firstOrFail(); //after using App\Post


      //return "Hello";
      // $posts = [
      //   'my-first-post' => 'Hello, this is my first post',
      //   'my-second-post' => 'Now I am getting the hang of this blogging thing'
      // ];

      // if(!array_key_exists($post,$posts)){
      //   abort(404, "Sorry, that post was not found");
      // }

      return view('post',[
        'post' => $post
      ]);
    }
}
