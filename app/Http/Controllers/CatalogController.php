<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('seller');

        // Apply search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Apply category filter
        if ($request->has('category')) {
            $categories = $request->input('category');
            if (!is_array($categories)) {
                $categories = [$categories];
            }
            $query->whereIn('category', $categories);
        }

        // Apply sorting
        $sort = $request->input('sort', 'popular');
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
            default:
                $query->withCount('reviews')
                      ->orderBy('reviews_count', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Product::distinct('category')->pluck('category');

        return view('catalog', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['seller', 'reviews.user', 'reviews.likedBy'])
            ->findOrFail($id);

        $relatedProducts = $product->relatedProducts();

        return view('product.show', compact('product', 'relatedProducts'));
    }

    public function toggleFavorite(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = $request->user();

        if ($product->isFavoritedBy($user)) {
            $product->favoritedBy()->detach($user->id);
            $message = 'Product removed from favorites';
        } else {
            $product->favoritedBy()->attach($user->id);
            $message = 'Product added to favorites';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'isFavorited' => $product->isFavoritedBy($user)
            ]);
        }

        return back()->with('success', $message);
    }

    public function toggleReviewLike(Request $request, $productId, $reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $user = $request->user();

        if ($review->isLikedBy($user)) {
            $review->likedBy()->detach($user->id);
            $review->decrement('likes');
            $message = 'Like removed from review';
        } else {
            $review->likedBy()->attach($user->id);
            $review->increment('likes');
            $message = 'Review liked';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'likes' => $review->likes,
                'isLiked' => $review->isLikedBy($user)
            ]);
        }

        return back()->with('success', $message);
    }
} 