<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Jobs\SetPostPhoto;

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
        return Cache::tags('posts-lists')->rememberForever('posts-page-' . request('page', 1), function () {
            return PostResource::collection(Post::published()->paginate());
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => auth('sanctum')->user()->id,
            'photo' => '',
            'is_published' => $request->has('is_published') ? $request->is_published : true
        ]);

        SetPostPhoto::dispatch($post);

        return response($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Cache::tags('post')->rememberForever('post-'. $post->id, function () use ($post) {
            return PostResource::make($post);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        
        return response()->noContent(202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent(204);
    }
}
