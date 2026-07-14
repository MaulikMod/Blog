<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $collection = "post";
    protected $primaryKey = '_id';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', '_id')->where('status', 1);
    }
}
