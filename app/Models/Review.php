<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'rating',
        'likes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'review_likes')->withTimestamps();
    }

    public function isLikedBy(User $user)
    {
        return $this->likedBy()->where('user_id', $user->id)->exists();
    }
} 