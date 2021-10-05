<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Laravelista\Comments\Commentable;

class Product extends Model implements LikeableContract
{
    use  Likeable, Commentable;
    // public function CategoryName(){
    //     return Category::find($this->id_category)->name;
    // }
    public function category(){
        return $this->belongsTo(Category::class, 'id_category');
    }
}
