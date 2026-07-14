<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'comments';

    protected $fillable = [
        'name',
        'comment',
        'post_id',
        'status'
    ];

    // Relationship
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
