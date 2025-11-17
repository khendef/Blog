<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\v1\Post\StorePostRequest;
use App\Http\Requests\v1\Post\UpdatePostRequest;
use App\Models\Post;
use App\Services\v1\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
  
    public function index(Request $request)
    {
        //posts?category=2&&author=1
        $categoryId = $request->query('category');
        $authorId = $request->query('author');

        $posts = $this->postService->index($authorId, $categoryId);
        
        return self::success($posts);
    }

   
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->store( $request->validated());

        return self::success($post, 'post created successfully' ,201);


    }

   
    public function show(Post $post)
    {
        $post->load(['author' , 'comments']);
        return self::success($post);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return self::success($post, 'post updated successfully' ,200);
       
    }

  
    public function destroy(Post $post)
    {
       $post->delete();
        return self::success(null, 'post deleted successfully' ,204);
    }
}
