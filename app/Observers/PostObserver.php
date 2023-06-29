<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        Cache::tags('posts-lists')->flush();

        if (Cache::tags('user-posts')->has('user-posts-' . $post->user->id)) {
            Cache::tags('user-posts')->forget('user-posts-' . $post->user->id);
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        Cache::tags('posts-lists')->flush();

        Cache::tags('post')->forget('post-' . $post->id);

        if (Cache::tags('user-posts')->has('user-posts-' . $post->user->id)) {
            Cache::tags('user-posts')->forget('user-posts-' . $post->user->id);
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        Cache::tags('posts-lists')->flush();
        
        Cache::tags('post')->forget('post-' . $post->id);

        if (Cache::tags('user-posts')->has('user-posts-' . $post->user->id)) {
            Cache::tags('user-posts')->forget('user-posts-' . $post->user->id);
        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        Cache::tags('posts-lists')->flush();

        Cache::tags('post')->forget('post-' . $post->id);

        if (Cache::tags('user-posts')->has('user-posts-' . $post->user->id)) {
            Cache::tags('user-posts')->forget('user-posts-' . $post->user->id);
        }
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        Cache::tags('posts-lists')->flush();

        Cache::tags('post')->forget('post-' . $post->id);

        if (Cache::tags('user-posts')->has('user-posts-' . $post->user->id)) {
            Cache::tags('user-posts')->forget('user-posts-' . $post->user->id);
        }
    }
}
