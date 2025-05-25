@extends('layouts.app')

@section('content')
<div class="favorites-container">
    <div class="favorites-header">
        <h1>My Favorites</h1>
        <p>{{ $favorites->total() }} items</p>
    </div>

    @if($favorites->isEmpty())
        <div class="empty-state">
            <img src="{{ asset('images/empty-favorites.png') }}" alt="No favorites">
            <h2>No favorites yet</h2>
            <p>Browse our catalog and add items to your favorites!</p>
            <a href="{{ route('catalog') }}" class="browse-button">Browse Catalog</a>
        </div>
    @else
        <div class="favorites-grid">
            @foreach($favorites as $favorite)
                <div class="favorite-card" data-product-id="{{ $favorite->product->id }}">
                    <div class="favorite-image">
                        <img src="{{ Storage::url($favorite->product->main_image) }}" alt="{{ $favorite->product->name }}">
                        <button onclick="removeFavorite({{ $favorite->product->id }})" class="remove-button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="favorite-info">
                        <h3>{{ $favorite->product->name }}</h3>
                        <p class="seller">by {{ $favorite->product->seller->name }}</p>
                        <div class="price-action">
                            <span class="price">Rp {{ number_format($favorite->product->price, 0, ',', ',') }}</span>
                            <button onclick="addToCart({{ $favorite->product->id }})" class="add-to-cart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $favorites->links() }}
        </div>
    @endif
</div>

<style>
.favorites-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.favorites-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.favorites-header h1 {
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

.favorites-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
}

.favorite-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.favorite-card:hover {
    transform: translateY(-4px);
}

.favorite-image {
    position: relative;
    padding-top: 100%;
}

.favorite-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.remove-button {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: background-color 0.3s;
}

.remove-button svg {
    width: 20px;
    height: 20px;
    color: #dc3545;
}

.remove-button:hover {
    background: #f8f9fa;
}

.favorite-info {
    padding: 1rem;
}

.favorite-info h3 {
    font-size: 1rem;
    margin: 0 0 0.25rem 0;
    color: #333;
}

.seller {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 1rem;
}

.price-action {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: 600;
    color: #1a5d1a;
}

.add-to-cart {
    padding: 0.5rem 1rem;
    background: #1a5d1a;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
    transition: background-color 0.3s;
}

.add-to-cart:hover {
    background: #134e13;
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .favorites-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .favorites-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>

<script>
function removeFavorite(productId) {
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
            const card = document.querySelector(`[data-product-id="${productId}"]`);
            card.style.opacity = '0';
            setTimeout(() => {
                card.remove();
                // Update count
                const count = document.querySelector('.favorites-header p');
                const currentCount = parseInt(count.textContent);
                count.textContent = `${currentCount - 1} items`;
                
                // Show empty state if no more favorites
                if (currentCount - 1 === 0) {
                    location.reload();
                }
            }, 300);
        }
    });
}

function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            const cartCount = document.querySelector('.cart-count .count');
            cartCount.textContent = data.cartCount;
            
            // Show success message
            const button = document.querySelector(`[data-product-id="${productId}"] .add-to-cart`);
            const originalText = button.textContent;
            button.textContent = 'Added!';
            button.style.background = '#28a745';
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '#1a5d1a';
            }, 2000);
        }
    });
}
</script>
@endsection 