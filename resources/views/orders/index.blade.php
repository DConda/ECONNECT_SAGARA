@extends('layouts.app')

@section('content')
<div class="orders-container">
    <div class="orders-header">
        <h1>Order History</h1>
        <p>{{ $orders->total() }} orders</p>
    </div>

    @if($orders->isEmpty())
        <div class="empty-state">
            <img src="{{ asset('images/empty-orders.png') }}" alt="No orders">
            <h2>No orders yet</h2>
            <p>Start shopping to see your order history!</p>
            <a href="{{ route('catalog') }}" class="browse-button">Browse Catalog</a>
        </div>
    @else
        <div class="orders-list">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <span class="order-number">Order #{{ $order->id }}</span>
                            <span class="order-date">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="order-status {{ strtolower($order->status) }}">
                            {{ $order->formatted_status }}
                        </div>
                    </div>

                    <div class="order-items">
                        @foreach($order->items as $item)
                            <div class="order-item">
                                <div class="item-image">
                                    <img src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->name }}">
                                </div>
                                <div class="item-details">
                                    <h3>{{ $item->product->name }}</h3>
                                    <p class="seller">by {{ $item->product->seller->name }}</p>
                                    <div class="item-meta">
                                        <span class="quantity">Qty: {{ $item->quantity }}</span>
                                        <span class="price">Rp {{ $item->formatted_price }}</span>
                                    </div>
                                </div>
                                <div class="item-subtotal">
                                    <span>Subtotal</span>
                                    <span class="amount">Rp {{ $item->formatted_subtotal }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <div class="order-total">
                            <span>Total</span>
                            <span class="amount">Rp {{ $order->formatted_total }}</span>
                        </div>
                        <a href="{{ route('orders.show', $order) }}" class="view-details">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<style>
.orders-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.orders-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.orders-header h1 {
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

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.order-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
}

.order-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.order-number {
    font-weight: 600;
    color: #333;
}

.order-date {
    font-size: 0.875rem;
    color: #666;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 999px;
    font-size: 0.875rem;
    font-weight: 500;
}

.order-status.pending {
    background: #fff3cd;
    color: #856404;
}

.order-status.processing {
    background: #cce5ff;
    color: #004085;
}

.order-status.completed {
    background: #d4edda;
    color: #155724;
}

.order-status.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.order-items {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.order-item {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.order-item:last-child {
    padding-bottom: 0;
    border-bottom: none;
}

.item-image {
    width: 80px;
    height: 80px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
}

.item-details h3 {
    font-size: 1rem;
    margin: 0 0 0.25rem 0;
    color: #333;
}

.seller {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.item-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.875rem;
    color: #666;
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
}

.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: #f8f9fa;
}

.order-total {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.order-total .amount {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a5d1a;
}

.view-details {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #1a5d1a;
    text-decoration: none;
    font-weight: 500;
}

.view-details svg {
    width: 16px;
    height: 16px;
    transition: transform 0.3s;
}

.view-details:hover svg {
    transform: translateX(4px);
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .order-item {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .item-image {
        margin: 0 auto;
    }

    .item-subtotal {
        text-align: center;
    }

    .order-footer {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}
</style>
@endsection 