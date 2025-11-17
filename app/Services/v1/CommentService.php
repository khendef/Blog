<?php

namespace App\Services\v1;

class CommentService
{
    public function index($post)
    {
        // all comments for a post
        $post = $post->load(['comments.user']);

        return $post;
    }

    public function store( $post, $data)
    {
        // add a comment for a post
        $data['user_id'] = auth()->user()->id;
        $post->comments()->create($data);
        $post = $post->load(['comments.user']);

        return $post;      
    }

   
    public function show( $post,$comment)
    {
        $post->load(['comments', function($query) use ($comment){
        $query->where('id', $comment->id);
        }] );

        return $post; 

       
    }

    
    public function update($data, $comment , $post)
    {
        $comment->update($data);
        $post->load('comments.user');
        
        return $post;
    }

}
