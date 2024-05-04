<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $post = new Post();
        $posts = $post->all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request){
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = rand(1, 10);
        $post->save();
        return redirect('/');
    }

    public function show($id){
        $post = Post::with('user')->where('id', $id)->firstOrFail();
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id){
        $post = Post::where('id', $id)->firstorFail();
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id){
        $post = Post::where('id', $id)->firstOrFail();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect('/');
    }

    public function destroy($id){
        $post = Post::where('id', $id)->firstOrFail();
        $post->delete();
        return redirect('/');
    }
}
