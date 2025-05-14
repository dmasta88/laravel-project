<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Post;
use Illuminate\Support\Arr;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $data = [
            'model' => 'post',
            'event' => 'created',
            'old_attributes' => null,
            'new_attributes' => $post->getDirty()
        ];
        Log::create($data);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $new = $post->getDirty();
        $old = Arr::only($post->getOriginal(), array_keys($new));
        $data = [
            'model' => 'post',
            'event' => 'updated',
            'old_attributes' => $old,
            'new_attributes' => $new
        ];
        Log::create($data);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleting(Post $post): void
    {
        $post->log_old_deleting = $post->getOriginal();
    }
    public function deleted(Post $post): void
    {
        $data = [
            'model' => 'post',
            'event' => 'deleted',
            'old_attributes' => $post->log_old_deleting,
            'new_attributes' => null
        ];
        Log::create($data);
    }
    /**
     * Handle the Post "retrieved" event.
     */
    public function retrieved(Post $post): void
    {
        $old = $post->getOriginal();
        $data = [
            'model' => 'post',
            'event' => 'retrieved',
            'old_attributes' => $old,
            'new_attributes' => null
        ];
        Log::create($data);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $new = $post->getDirty();
        $old = Arr::only($post->getOriginal(), array_keys($new));
        $data = [
            'model' => 'post',
            'event' => 'restored',
            'old_attributes' => $old,
            'new_attributes' => $new
        ];
        Log::create($data);
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $data = [
            'model' => 'post',
            'event' => 'forceDeleted',
            'old_attributes' => $post->log_old_deleting,
            'new_attributes' => null
        ];
        Log::create($data);
    }
}
