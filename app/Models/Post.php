<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','image', 'caption'];

    // One-to-many relationship with likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
