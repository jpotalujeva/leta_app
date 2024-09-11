<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Post;

class Category extends Model
{
     protected $fillable = [
        'name'
    ];

    public function post(): BelongsToMany
    {
        return $this->BelongsToMany(Post::class, 'post_category', 'categories_id', 'post_id');
    }
}
