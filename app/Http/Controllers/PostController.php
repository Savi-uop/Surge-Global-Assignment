<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller

{
    public function index()
    {
        $posts = Post::with('user') 
        ->orderByDesc('likes')  
        ->orderByDesc('created_at') 
        ->get();

        return view('dashboard', compact('posts'));
    }

    public function create()
    {
        return view('posts.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Create a new post, user_id is set by the authenticated user
        Post::create([
            'user_id' => auth()->id(), // This still works even if you pass it from the form
            'caption' => $request->input('caption'),
            'image' => isset($imagePath) ? $imagePath : null,
            'likes_count' => 0, // You can initialize likes count to 0 or a default value
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function likePost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        // Check if the user already liked the post
        $existingLike = Like::where('post_id', $post->id)
                            ->where('user_id', auth()->id())
                            ->first();

        if ($existingLike) {
            // Unlike the post
            $existingLike->delete();
            $liked = false;

            // Optionally decrement the `likes` count in the posts table
            $post->decrement('likes');
        } else {
            // Like the post
            Like::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
            ]);
            $liked = true;

            // Optionally increment the `likes` count in the posts table
            $post->increment('likes');
        }

        // Return the updated likes count
        return response()->json([
            'likes_count' => $post->likes->count(), // Use relationship if exists
            'liked' => $liked,
        ]);
    }

}
