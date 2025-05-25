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
                    <span class="count">{{ session()->get('cart', []) ? count(session()->get('cart', [])) : 0 }}</span>
                </a>
            </div>
            <div class="user-profile">
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="{{ route('home') }}" @if(request()->routeIs('home')) class="active" @endif>Home</a></li>
            <li><a href="{{ route('catalog') }}" @if(request()->routeIs('catalog')) class="active" @endif>Catalog</a></li>
            <li><a href="{{ route('favorites') }}" @if(request()->routeIs('favorites')) class="active" @endif>Favorites</a></li>
            <li><a href="{{ route('cart') }}" @if(request()->routeIs('cart')) class="active" @endif>Cart</a></li>
            <li><a href="{{ route('orders') }}" @if(request()->routeIs('orders')) class="active" @endif>Order History</a></li>
            @if(Auth::user()->email === 'seller@econnect.com')
            <li><a href="{{ route('product.create') }}" @if(request()->routeIs('product.create')) class="active" @endif>Add Product</a></li>
            @endif
        </ul>
    </nav>
</header> 