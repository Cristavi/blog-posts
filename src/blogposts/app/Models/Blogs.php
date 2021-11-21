<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blogs extends Model
{
    use HasFactory;




    protected $fillable = [
        'user_id', 'body', 'content_image'
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function has(): HasMany{
        return $this->hasMany(Likes::class);
    }

    public function likedBy(User $user){
        return $this->has->contains('user_id', $user->id);
    }

    public function have(): HasMany{
        return $this->hasMany(Comments::class);
    }
}
