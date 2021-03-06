<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 'blogs_id', 'comment_body'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }



}
