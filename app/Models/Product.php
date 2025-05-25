<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit',
        'main_image',
        'additional_images',
        'seller_id',
        'category',
        'variants',
        'stock'
    ];

    protected $casts = [
        'additional_images' => 'array',
        'variants' => 'array',
        'price' => 'decimal:2'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function relatedProducts()
    {
        return $this->where('seller_id', $this->seller_id)
            ->where('id', '!=', $this->id)
            ->take(3)
            ->get();
    }
} 