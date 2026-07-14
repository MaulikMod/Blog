<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $connection = 'mongodb'; // Force use of mongo connection
    protected $collection = 'users';   // MongoDB uses "collections" not tables

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];
}
