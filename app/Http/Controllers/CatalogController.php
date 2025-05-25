<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['seller', 'reviews']);

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

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|in:kg,m,pcs',
            'stock' => 'required|integer|min:0',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle main image
        $mainImagePath = $request->file('main_image')->store('products', 'public');

        // Handle additional images
        $additionalImagePaths = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $additionalImagePaths[] = $image->store('products', 'public');
            }
        }

        // Create product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'main_image' => $mainImagePath,
            'additional_images' => $additionalImagePaths,
            'seller_id' => auth()->id()
        ]);

        return redirect()->route('product.show', $product->id)
            ->with('success', 'Product added successfully');
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