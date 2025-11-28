<?php

namespace App\Services\v1;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;


class PostService
{
   public function index($authorId ,$categoryId)
   {
        try{
            $posts = Post::with(['author' , 'category'])
                            ->WherePublished()
                            ->WhereCategory($categoryId)
                            ->whereAuthor($authorId)
                            ->orderBy('created_at' , 'desc')
                            ->paginate(10);
            
            return $posts;
        }catch(Exception $e){}
   }

   public function store($data)
   {
       // try{
                return DB::transaction(function() use($data) {
                $data['author_id'] = auth()->user()->id;
                $post = Post::create($data);
                if(isset($data['comment'])){
                    $post->comments()->create([
                        'user_id' => auth()->user()->id,
                        'body' => $data['comment']
                    ]);
                } 
                $post->load(['author' => function ($query) {
                                $query->select('id', 'name'); 
                            }]);           
                return $post;  
            });
      //  }catch(Exception $e){
      //      \log::error("Message: ".$e->getMessage()."File: ".$e->getFile()."Line: ".$e->getLine());
      // }
   }

}
