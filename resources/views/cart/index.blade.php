@extends('layouts.app')

@section('content')
<div class="cart-container">
    <div class="cart-header">
        <h1>Shopping Cart</h1>
        <p>{{ count($cart) }} items</p>
    </div>

    @if(empty($cart))
        <div class="empty-state">
            <img src="{{ asset('images/empty-cart.png') }}" alt="Empty cart">
            <h2>Your cart is empty</h2>
            <p>Add items to your cart to start shopping!</p>
            <a href="{{ route('catalog') }}" class="browse-button">Browse Catalog</a>
        </div>
    @else
        <div class="cart-content">
            <div class="cart-items">
                @foreach($products as $product)
                    <div class="cart-item" data-product-id="{{ $product->id }}">
                        <div class="item-image">
                            <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="item-details">
                            <h3>{{ $product->name }}</h3>
                            <p class="seller">by {{ $product->seller->name }}</p>
                            <p class="price">Rp {{ number_format($product->price, 0, ',', ',') }}</p>
                        </div>
                        <div class="item-quantity">
                            <div class="quantity-control">
                                <button class="qty-btn minus" onclick="updateQuantity({{ $product->id }}, -1)">-</button>
                                <input type="number" value="{{ $cart[$product->id] }}" min="1" max="{{ $product->stock }}" 
                                       onchange="updateQuantity({{ $product->id }}, this.value, true)">
                                <button class="qty-btn plus" onclick="updateQuantity({{ $product->id }}, 1)">+</button>
                            </div>
                            <button class="remove-button" onclick="removeItem({{ $product->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Remove
                            </button>
                        </div>
                        <div class="item-subtotal">
                            <span>Subtotal</span>
                            <span class="amount">Rp {{ number_format($product->price * $cart[$product->id], 0, ',', ',') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', ',') }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', ',') }}</span>
                </div>
                <form action="{{ route('orders.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-button">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<style>
.cart-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.cart-header h1 {
    font-size: 2rem;
    font-weight: 600;
    color: #1a5d1a;
}

.empty-state {
    text-align: center;
    padding: 4rem 0;
}

.empty-state img {
    width: 200px;
    height: 200px;
    margin-bottom: 1.5rem;
}

.empty-state h2 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.empty-state p {
    color: #666;
    margin-bottom: 1.5rem;
}

.browse-button {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: #1a5d1a;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.browse-button:hover {
    background: #134e13;
}

.cart-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2rem;
}

.cart-items {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.cart-item {
    display: grid;
    grid-template-columns: auto 1fr auto auto;
    gap: 1.5rem;
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
}

.cart-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 100px;
    height: 100px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
}

.item-details h3 {
    font-size: 1.125rem;
    margin: 0 0 0.25rem 0;
    color: #333;
}

.seller {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.price {
    font-weight: 600;
    color: #1a5d1a;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.qty-btn {
    width: 32px;
    height: 32px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: #f5f5f5;
}

.quantity-control input {
    width: 50px;
    height: 32px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.remove-button {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.remove-button svg {
    width: 16px;
    height: 16px;
}

.remove-button:hover {
    text-decoration: underline;
}

.item-subtotal {
    text-align: right;
}

.item-subtotal span {
    display: block;
}

.item-subtotal .amount {
    font-weight: 600;
    color: #1a5d1a;
    font-size: 1.125rem;
}

.cart-summary {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    height: fit-content;
}

.cart-summary h2 {
    font-size: 1.25rem;
    margin: 0 0 1.5rem 0;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.summary-row.total {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    font-weight: 600;
    font-size: 1.125rem;
}

.checkout-button {
    width: 100%;
    padding: 1rem;
    background: #1a5d1a;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    margin-top: 1.5rem;
    transition: background-color 0.3s;
}

.checkout-button:hover {
    background: #134e13;
}

@media (max-width: 992px) {
    .cart-content {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .cart-item {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .item-image {
        margin: 0 auto;
    }

    .quantity-control {
        justify-content: center;
    }

    .item-subtotal {
        text-align: center;
    }
}
</style>

<script>
function updateQuantity(productId, change, isInput = false) {
    let input = document.querySelector(`[data-product-id="${productId}"] input`);
    let currentQty = parseInt(input.value);
    let newQty;
    
    if (isInput) {
        newQty = parseInt(change);
    } else {
        newQty = currentQty + parseInt(change);
    }
    
    // Validate quantity
    if (newQty < 1 || newQty > parseInt(input.max)) {
        return;
    }

    fetch(`/cart/update/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity
            input.value = newQty;
            
            // Update subtotal
            const price = parseFloat(document.querySelector(`[data-product-id="${productId}"] .price`).textContent.replace(/[^0-9.-]+/g, ''));
            const subtotal = price * newQty;
            document.querySelector(`[data-product-id="${productId}"] .amount`).textContent = `Rp ${numberFormat(subtotal)}`;
            
            // Update total
            document.querySelector('.summary-row.total span:last-child').textContent = `Rp ${numberFormat(data.total)}`;
        }
    });
}

function removeItem(productId) {
    fetch(`/cart/remove/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const item = document.querySelector(`[data-product-id="${productId}"]`);
            item.style.opacity = '0';
            setTimeout(() => {
                item.remove();
                
                // Update cart count in header
                const cartCount = document.querySelector('.cart-count .count');
                cartCount.textContent = data.cartCount;
                
                // Update total
                document.querySelector('.summary-row.total span:last-child').textContent = `Rp ${numberFormat(data.total)}`;
                
                // Reload if cart is empty
                if (data.cartCount === 0) {
                    location.reload();
                }
            }, 300);
        }
    });
}

function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}
</script>
@endsection 