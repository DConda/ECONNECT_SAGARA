@extends('layouts.app')

@section('content')
<div class="order-container">
    <div class="order-header">
        <div class="header-left">
            <a href="{{ route('orders') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Orders
            </a>
            <h1>Order #{{ $order->id }}</h1>
        </div>
        <div class="order-status {{ strtolower($order->status) }}">
            {{ $order->formatted_status }}
        </div>
    </div>

    <div class="order-grid">
        <div class="order-details">
            <div class="section">
                <h2>Order Information</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Order Date</span>
                        <span class="value">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Order Status</span>
                        <span class="value status {{ strtolower($order->status) }}">{{ $order->formatted_status }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Payment Method</span>
                        <span class="value">Cash on Delivery</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Shipping Method</span>
                        <span class="value">Standard Delivery</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Shipping Address</h2>
                <div class="address-info">
                    <p class="name">{{ $order->user->name }}</p>
                    <p class="address">{{ $order->user->address }}</p>
                    <p class="phone">{{ $order->user->phone }}</p>
                </div>
            </div>

            <div class="section">
                <h2>Order Items</h2>
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
            </div>
        </div>

        <div class="order-summary">
            <div class="summary-card">
                <h2>Order Summary</h2>
                <div class="summary-content">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp {{ $order->formatted_total }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>Rp {{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

            <div class="tracking-card">
                <h2>Order Tracking</h2>
                <div class="tracking-timeline">
                    <div class="timeline-item {{ $order->status == 'completed' ? 'completed' : ($order->status == 'cancelled' ? 'cancelled' : '') }}">
                        <div class="timeline-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <h3>Order Placed</h3>
                            <p>{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ in_array($order->status, ['processing', 'completed']) ? 'completed' : ($order->status == 'cancelled' ? 'cancelled' : '') }}">
                        <div class="timeline-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <h3>Processing</h3>
                            <p>Order is being processed</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status == 'completed' ? 'completed' : ($order->status == 'cancelled' ? 'cancelled' : '') }}">
                        <div class="timeline-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <h3>Completed</h3>
                            <p>Order has been delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.back-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
    text-decoration: none;
    font-weight: 500;
}

.back-link svg {
    width: 20px;
    height: 20px;
}

.back-link:hover {
    color: #1a5d1a;
}

.order-header h1 {
    font-size: 2rem;
    font-weight: 600;
    color: #1a5d1a;
    margin: 0;
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

.order-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 2rem;
}

.section {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.section h2 {
    font-size: 1.25rem;
    margin: 0 0 1.5rem 0;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-item .label {
    font-size: 0.875rem;
    color: #666;
}

.info-item .value {
    font-weight: 500;
    color: #333;
}

.info-item .value.status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
}

.address-info {
    color: #333;
}

.address-info .name {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.address-info .address,
.address-info .phone {
    margin: 0;
    line-height: 1.5;
}

.order-items {
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

.summary-card,
.tracking-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.summary-card h2,
.tracking-card h2 {
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

.tracking-timeline {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.timeline-item {
    display: flex;
    gap: 1rem;
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 40px;
    left: 20px;
    width: 2px;
    height: calc(100% + 1rem);
    background: #ddd;
}

.timeline-item.completed:not(:last-child)::after {
    background: #1a5d1a;
}

.timeline-item.cancelled:not(:last-child)::after {
    background: #dc3545;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border: 2px solid #ddd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.timeline-icon svg {
    width: 20px;
    height: 20px;
    color: #666;
}

.timeline-item.completed .timeline-icon {
    background: #1a5d1a;
    border-color: #1a5d1a;
}

.timeline-item.completed .timeline-icon svg {
    color: white;
}

.timeline-item.cancelled .timeline-icon {
    background: #dc3545;
    border-color: #dc3545;
}

.timeline-item.cancelled .timeline-icon svg {
    color: white;
}

.timeline-content h3 {
    font-size: 1rem;
    margin: 0 0 0.25rem 0;
    color: #333;
}

.timeline-content p {
    margin: 0;
    font-size: 0.875rem;
    color: #666;
}

@media (max-width: 992px) {
    .order-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

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
}
</style>
@endsection 