<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'created_at'
    ];

    public function user_id(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'categories_id');
    }
}
