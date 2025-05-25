<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        
        $order->load(['items.product', 'user']);
        
        return view('orders.show', compact('order'));
    }

    public function create(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $total += $product->price * $quantity;
        }

        $order = $request->user()->orders()->create([
            'total' => $total,
            'status' => 'pending'
        ]);

        foreach ($products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $cart[$product->id],
                'price' => $product->price
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully');
    }
} 