<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    // protected $fillable = ['user_id', 'post_id'];

    // Belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
