<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - Econnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('home') }}">ECONNECT</a>
            </div>
            <div class="user-section">
                <form class="search-form" action="{{ route('catalog') }}" method="GET">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                </form>
                <div class="cart-count">
                    <a href="{{ route('cart') }}">
                        <img src="{{ asset('images/cart.png') }}" alt="Cart">
                        <span class="count">3</span>
                    </a>
                </div>
                <div class="user-profile">
                    <span>Veronica G</span>
                </div>
            </div>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('catalog') }}" class="active">Catalog</a></li>
                <li><a href="{{ route('favorites') }}">Favorites</a></li>
                <li><a href="{{ route('cart') }}">Cart</a></li>
                <li><a href="{{ route('orders') }}">Order History</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="product-content">
        <div class="product-container">
            <!-- Product Images -->
            <div class="product-images">
                <div class="main-image">
                    <img src="{{ asset('images/' . $product['images']['main']) }}" alt="{{ $product['name'] }}">
                </div>
                <div class="thumbnail-images">
                    @foreach($product['images']['thumbnails'] as $thumbnail)
                    <div class="thumbnail">
                        <img src="{{ asset('images/' . $thumbnail) }}" alt="Product thumbnail">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <div class="product-header">
                    <h1>{{ $product['name'] }}</h1>
                    <div class="actions">
                        <button class="favorite-btn">
                            <img src="{{ asset('images/heart.png') }}" alt="Add to favorites">
                        </button>
                        <button class="share-btn">
                            <img src="{{ asset('images/share.png') }}" alt="Share">
                        </button>
                    </div>
                </div>

                <div class="price-section">
                    <h2>Rp{{ number_format($product['price'], 0, ',', ',') }} / {{ $product['unit'] }}</h2>
                </div>

                <div class="description">
                    <p>{{ $product['description'] }}</p>
                </div>

                <div class="variants">
                    <h3>Variants</h3>
                    <div class="variant-options">
                        @foreach($product['variants'] as $variant)
                        <button class="variant-btn {{ $loop->first ? 'active' : '' }}">{{ $variant }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="quantity">
                    <h3>Quantity</h3>
                    <div class="quantity-controls">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" value="1" min="1">
                        <button class="quantity-btn plus">+</button>
                    </div>
                </div>

                <button class="buy-now-btn">Buy Now</button>

                <div class="seller-info">
                    <img src="{{ asset('images/seller-avatar.png') }}" alt="{{ $product['seller']['name'] }}">
                    <div class="seller-details">
                        <h3>{{ $product['seller']['name'] }}</h3>
                        <p>{{ $product['seller']['location'] }}</p>
                        <div class="rating">
                            <span>{{ $product['seller']['rating'] }}</span>
                            <img src="{{ asset('images/star.png') }}" alt="Rating">
                            <span>({{ $product['seller']['reviews'] }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="reviews-section">
            <h2>Buyer Reviews</h2>
            @foreach($product['reviews'] as $review)
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-info">
                        <img src="{{ asset('images/user-avatar.png') }}" alt="{{ $review['user'] }}">
                        <div>
                            <h3>{{ $review['user'] }}</h3>
                            <div class="rating">
                                @for($i = 0; $i < $review['rating']; $i++)
                                <img src="{{ asset('images/star.png') }}" alt="star">
                                @endfor
                            </div>
                        </div>
                    </div>
                    <span class="review-date">{{ $review['date'] }}</span>
                </div>
                <p class="review-text">{{ $review['comment'] }}</p>
                <div class="review-actions">
                    <button class="like-btn">
                        <img src="{{ asset('images/like.png') }}" alt="Like">
                        <span>{{ $review['likes'] }}</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h2>More Products from This Shop</h2>
            <div class="product-grid">
                @foreach($product['related_products'] as $related)
                <div class="product-card">
                    <img src="{{ asset('images/' . $related['image']) }}" alt="{{ $related['name'] }}">
                    <div class="product-info">
                        <h3>{{ $related['name'] }}</h3>
                        <p class="price">Rp{{ number_format($related['price'], 0, ',', ',') }} / {{ $related['unit'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</body>
</html> 