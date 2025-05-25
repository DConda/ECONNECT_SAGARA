<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Econnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<body>
    @include('layouts.header')

    <!-- Main Content -->
    <main class="product-content">
        <div class="breadcrumb">
            <a href="{{ route('catalog') }}">Catalog</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </div>

        <div class="product-container">
            <!-- Product Images -->
            <div class="product-images">
                <div class="main-image">
                    <img src="{{ Storage::url($product->main_image) }}" 
                         alt="{{ $product->name }}"
                         onerror="this.src='{{ asset('images/placeholder.png') }}'">
                </div>
                @if($product->additional_images)
                <div class="thumbnail-images">
                    @foreach(json_decode($product->additional_images) as $image)
                    <div class="thumbnail">
                        <img src="{{ Storage::url($image) }}" 
                             alt="{{ $product->name }}"
                             onerror="this.src='{{ asset('images/placeholder.png') }}'">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                <div class="price-section">
                    <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}</p>
                    <div class="rating">
                        <span>{{ number_format($product->average_rating, 1) }}</span>
                        <img src="{{ asset('images/star.png') }}" alt="Rating">
                        <span>({{ $product->reviews_count }} reviews)</span>
                    </div>
                </div>

                <div class="seller-section">
                    <p>Sold by <span class="seller-name">{{ $product->seller->name }}</span></p>
                </div>

                <div class="description">
                    <h2>Description</h2>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="stock-info">
                    <p>Stock: {{ $product->stock }} {{ $product->unit }}s available</p>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="purchase-form">
                    @csrf
                    <div class="quantity-control">
                        <label for="quantity">Quantity ({{ $product->unit }})</label>
                        <div class="quantity-buttons">
                            <button type="button" class="qty-btn minus">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}">
                            <button type="button" class="qty-btn plus">+</button>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                        <button type="button" class="favorite-btn" onclick="toggleFavorite({{ $product->id }})">
                            <img src="{{ asset('images/heart.png') }}" alt="Favorite">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section">
            <h2>Reviews</h2>
            @if($product->reviews->count() > 0)
                @foreach($product->reviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <span class="reviewer-name">{{ $review->user->name }}</span>
                            <div class="review-rating">
                                <span>{{ $review->rating }}</span>
                                <img src="{{ asset('images/star.png') }}" alt="Rating">
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>
                    <p class="review-comment">{{ $review->comment }}</p>
                    <div class="review-actions">
                        <button onclick="toggleReviewLike({{ $review->id }})" class="like-btn">
                            <img src="{{ asset('images/like.png') }}" alt="Like">
                            <span>{{ $review->likes }}</span>
                        </button>
                    </div>
                </div>
                @endforeach
            @else
                <p class="no-reviews">No reviews yet.</p>
            @endif
        </div>
    </main>

    <script>
        // Quantity control
        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const currentValue = parseInt(input.value);
                const max = parseInt(input.max);
                
                if (this.classList.contains('minus') && currentValue > 1) {
                    input.value = currentValue - 1;
                } else if (this.classList.contains('plus') && currentValue < max) {
                    input.value = currentValue + 1;
                }
            });
        });

        // Favorite toggle
        function toggleFavorite(productId) {
            fetch(`/catalog/${productId}/favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const btn = document.querySelector('.favorite-btn');
                    btn.classList.toggle('active');
                }
            });
        }

        // Review like toggle
        function toggleReviewLike(reviewId) {
            fetch(`/catalog/{{ $product->id }}/reviews/${reviewId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likeCount = document.querySelector(`[data-review-id="${reviewId}"] .like-count`);
                    likeCount.textContent = data.likes;
                }
            });
        }
    </script>
</body>
</html> 