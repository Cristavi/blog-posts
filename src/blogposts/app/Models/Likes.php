<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'blog_id'
    ];
}
