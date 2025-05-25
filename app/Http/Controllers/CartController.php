<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();
            
            foreach ($products as $product) {
                $quantity = $cart[$product->id];
                $total += $product->price * $quantity;
            }
        }

        return view('cart.index', compact('products', 'cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $variant = $request->input('variant');

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart',
                'cartCount' => count($cart)
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');
        
        if ($quantity <= 0) {
            return $this->remove($request, $product);
        }

        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id] = $quantity;
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated',
                'total' => $this->calculateTotal($cart)
            ]);
        }

        return back()->with('success', 'Cart updated');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart',
                'cartCount' => count($cart),
                'total' => $this->calculateTotal($cart)
            ]);
        }

        return back()->with('success', 'Product removed from cart');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        $products = Product::whereIn('id', array_keys($cart))->get();
        
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        return $total;
    }
} 