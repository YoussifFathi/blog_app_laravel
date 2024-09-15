<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.index',["posts"=>$posts],);
    }

    public function show($postId){
        $post = Post::findOrFail($postId);
        return view('posts.show',["post"=>$post],);
    }

    public function create(){
        $users = User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store(){

        request()->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:6'],
            'user_id' => ['required','exists:users,id']
        ]);

        $data = request()->all();
        Post::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $data['user_id'],
        ]);
        return to_route('posts.index');
    }


    public function edit($id){
        $users = User::all();
        $post = Post::findOrFail($id);

        return view('posts.edit',['id'=>$id,'users'=>$users,'post'=>$post]);
    }


    public function update($id){
        request()->validate([
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:6'],
            'user_id' => ['required','exists:users,id']
        ]);

        $data = request()->all();
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => $data['user_id'],
        ]);
        return to_route('posts.index',[]);
    }

    public function destroy($id){
        Post::destroy($id);
        return to_route('posts.index');
    }


}
