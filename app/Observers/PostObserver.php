<?php

namespace App\Observers;

use App\Enums\PostStatus;
use App\Jobs\SendEmail;
use App\Models\Post;

class PostObserver
{
     
    public function updated(Post $post): void
    {

        if($post->isDirty('status')&& $post->status = PostStatus::PUBLISHED){
            SendEmail::dispatch($post);
        }
        
    }
 
}
