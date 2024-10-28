<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Events\PostCreated;

class PostController extends Controller
{
    //
    public function index()
    {
        return Post::all();
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    public function store(Request $request, Website $website)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post = $website->posts()->create([
            'title' => $request['title'],
            'description' => $request['description'],
            'sent' => false, // Default to false when creating a post
        ]);

        // Optionally trigger the event to send notifications
        event(new PostCreated($post));

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::find($id);

        // If the post doesn't exist, return an error
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Validate input data (ensure only valid fields are updated)
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'sent' => 'sometimes|boolean',
        ]);

        // Update the post with only the validated fields
        $post->update($request->only(['title', 'description', 'sent']));

        // Return the updated post
        return response()->json($post, 200);
    }
}
