<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct ()
    {
        $this->authorizeResource(Post::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::published()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'photo' => '',
            'is_published' => (bool) $request->is_published
        ]);

        return response()->created();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        
        return response()->accepted();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->deleted();
    }
}
