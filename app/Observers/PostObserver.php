<?php

namespace App\Observers;

use App\Models\Post;

use function Pest\Laravel\get;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function restoring(Post $post)
    {
        return false;
    }

    public function created(Post $post)
    {
        //  $deletedPost=Post::query()
        //  ->withTrashed()
        //  ->where('post_code',$request->post_code)
        //  ->first();
        //  if($deletedPost){
        //      $deletedPost->update([
        //          'post_code'=>$deletedPost->post_code."_".time()
        //      ]);
        //  }


    }
    public function creating(Post $post)
    {

        $deletedPost = Post::query()
            ->withTrashed()
            ->where('post_code', $post->post_code)
            ->first();
        if ($deletedPost) {
            $deletedPost->update([
                'post_code' => $deletedPost->post_code . "_" . time()
            ]);
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
