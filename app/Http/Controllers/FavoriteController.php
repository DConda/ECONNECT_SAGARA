<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = $request->user()
            ->favorites()
            ->with(['product.seller'])
            ->latest()
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }
} 