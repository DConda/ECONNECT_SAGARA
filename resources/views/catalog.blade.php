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
    @include('layouts.header')

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
                                       name="category[]" value="{{ $category }}"
                                       {{ in_array($category, request('category', [])) ? 'checked' : '' }}>
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
                    <span class="product-count">Showing {{ $products->count() }} Products</span>
                    <div class="sort-dropdown">
                        <select name="sort" id="sort">
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="product-grid">
                    @foreach($products as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="product-link">
                        <div class="product-card">
                            @if($product->main_image)
                                <img src="{{ Storage::url($product->main_image) }}" 
                                     alt="{{ $product->name }}"
                                     onerror="this.src='{{ asset('images/placeholder.png') }}'"
                                     loading="lazy">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" alt="No image available">
                            @endif
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}</p>
                                <div class="seller-info">
                                    <span class="seller">{{ $product->seller->name }}</span>
                                    <div class="rating">
                                        <span>{{ number_format($product->average_rating, 1) }} ({{ $product->reviews_count }})</span>
                                        <img src="{{ asset('images/star.png') }}" alt="Rating">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                @if($products->hasPages())
                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        // Handle category filter changes
        document.querySelectorAll('input[name="category[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const form = checkbox.closest('form');
                const checkedCategories = Array.from(form.querySelectorAll('input[name="category[]"]:checked'))
                    .map(input => input.value);
                
                const url = new URL(window.location.href);
                if (checkedCategories.length > 0) {
                    url.searchParams.set('category', checkedCategories);
                } else {
                    url.searchParams.delete('category');
                }
                window.location.href = url.toString();
            });
        });

        // Handle sort changes
        document.getElementById('sort').addEventListener('change', function() {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', this.value);
            window.location.href = url.toString();
        });
    </script>
</body>
</html> 