<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;

  //restricts columns from modifying
  protected $guarded = [];


  public function comments()
  {
    return $this->hasMany(Comment::class, 'on_post');
  }

  // returns the instance of the user who is author of that post
  public function author()
  {
    return $this->belongsTo(User::class, 'author_id'); // remove 
  }
  
   // user has many posts
   public function posts()
   {
     return $this->hasMany(Post::class, 'author_id');
   }
 
   
}
