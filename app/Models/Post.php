<?php

namespace App\Models;

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
    
    public function author(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
