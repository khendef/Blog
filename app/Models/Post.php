<?php

namespace App\Models;

use App\Builders\PostBuilder;
use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'abstract',
        'body',
        'author_id',
        'category_id'

    ];

    protected function casts(): array
    {
        return [
            'status'=>PostStatus::class
        ];
    }
    
    public function author(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function newEloquentBuilder($query){
        return new PostBuilder($query);
    }

    // public function scopeWherePublished($query){
       
    //     return $query->where('published', true);
    // }

    // public function scopeWhereAuthor($query, $authorId){
    //     if($authorId){
    //          return $query->where('author_id' , $authorId);
    //     }
    //     return $query;
    // }

    // public function scopeWhereCategory($query, $categoryId){

    //     if($categoryId){
    //         return $query->where('category_id', $categoryId);
    //     }
    //     return $query;
    // }
}
