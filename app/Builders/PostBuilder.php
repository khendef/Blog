<?php
namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class PostBuilder extends Builder
{
    public function WherePublished(){
       
        return $this->where('published', true);
    }

    public function WhereAuthor( $authorId){
        
        return $this->where('author_id' , $authorId);
    }

    public function WhereCategory( $categoryId){

        return $this->where('category_id', $categoryId);

    }
}











?>