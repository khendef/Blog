<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);
        
        Gate::define('update_post', function ($user, $post) {
            // for update and delete
            if ($user->is_admin){
                 return true;
            }
            return $user->id === $post->author_id;
        });

        Gate::define('update_comment', function ($user, $comment) {
            // only user who made the comment can update its body
            return $user->id === $comment->user_id;
        });
        Gate::define('delete_comment', function ($user, $comment) {
            if ($user->is_admin){ // admin can delete other users comments
                 return true;
            } 
            return $user->id === $comment->user_id;
        });

        Gate::define('admin_only', function($user) {
            return $user->is_admin;
        });

    }
}
