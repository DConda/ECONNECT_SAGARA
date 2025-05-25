<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog - Econnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
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
    <main class="catalog-content">
        <h1>Product Catalog</h1>
        <p class="subtitle">Explore various types of materials and waste that can still be repurposed.</p>

        <div class="catalog-container">
            <!-- Filter Sidebar -->
            <aside class="filter-sidebar">
                <div class="filter-section">
                    <h2>Filter</h2>
                    <div class="category-filter">
                        <h3>Category</h3>
                        <form>
                            @foreach($categories as $category)
                            <div class="checkbox-group">
                                <input type="checkbox" id="{{ strtolower(str_replace(' & ', '-', $category)) }}" 
                                       name="category[]" value="{{ $category }}">
                                <label for="{{ strtolower(str_replace(' & ', '-', $category)) }}">{{ $category }}</label>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="product-section">
                <div class="product-controls">
                    <span class="product-count">Showing {{ count($products) }} Products</span>
                    <div class="sort-dropdown">
                        <select name="sort" id="sort">
                            <option value="popular">Popular</option>
                            <option value="newest">Newest</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="product-grid">
                    @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p class="price">Rp{{ number_format($product->price, 0, ',', ',') }} / {{ $product->unit }}</p>
                            <div class="seller-info">
                                <span class="seller">{{ $product->seller->name }}</span>
                                <div class="rating">
                                    <span>{{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }})</span>
                                    <img src="{{ asset('images/star.png') }}" alt="Rating">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="load-more">Show More</button>
            </div>
        </div>
    </main>
</body>
</html> 