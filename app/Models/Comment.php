<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
   protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];


    public function user_id(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }

    public function post_id(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'foreign_key');
    }
}
