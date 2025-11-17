<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\v1\Comment\StoreCommentRequest;
use App\Http\Requests\v1\Comment\updateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\v1\CommentService;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService){
        $this->commentService = $commentService;
    }
   
    public function index(Post $post)
    {
        $post = $this->commentService->index($post);

        return self::success($post);
    }

    public function store(StoreCommentRequest $request, Post $post)
    {       
        $post = $this->commentService->store($post , $request->validated());

        return self::success($post, 'comment created successfully', 201);       
    }

   
    public function show(Post $post,Comment $comment)
    {
        $post = $this->commentService->show($post , $comment);

        return self::success($post); 

       
    }

    
    public function update(updateCommentRequest $request, Comment $comment , Post $post)
    {
        $post = $this->commentService->update($request->validated(),$comment,$post);
        return self::success($post);
    }

    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return self::success(null, 'comment deleted successfully' ,204);
        
    }
}
