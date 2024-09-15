<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PostController extends Controller
{
    
    public function getAllPosts()
    {
        $posts = Post::all();
        return response()->json($posts); 
    }

    public function getPost($id)
    {
        try{
            $post = Post::findOrFail($id);
        return response()->json($post); 
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function create(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:6'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'body' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try{
            $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();
        return response()->json($post);
        }    catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully', 'post' => $post]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
}
