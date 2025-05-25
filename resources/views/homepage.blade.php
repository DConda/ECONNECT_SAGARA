<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ECONNECT</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>ECONNECT</h1>
      <h2>Hello</h2>
    </div>

    <div class="navbar">
      <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'active' : '' }}">Catalog</a></li>
        <li><a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'active' : '' }}">Favorites</a></li>
        <li><a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'active' : '' }}">Cart</a></li>
        <li><a href="{{ route('orders') }}" class="{{ request()->routeIs('orders') ? 'active' : '' }}">Order History</a></li>
      </ul>

      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
      </div>

      <div class="cart-icon">
        <a href="{{ route('cart') }}"><img src="{{ asset('images/cart.png') }}" alt="Cart"></a>
      </div>

      <div class="user-icon">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-button">
            <img src="{{ asset('images/user.png') }}" alt="User">
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="hero">
    <h1>Rethink</h1>
    <h1>Reuse</h1>
    <h1>Reconnect</h1>
  </div>

  <div class="content">
    <!-- Featured Categories -->
    <div class="section">
      <h2>Featured Categories</h2>
      <p>Discover recycled items from various types of waste. Ready to be your creative and eco-friendly solution!</p>
      <button>View More</button>

      <div class="categories">
        <div class="category">
          <img src="{{ asset('images/Product Image.png') }}" alt="Plastic Waste">
          <h3>Plastic Waste</h3>
        </div>
        <div class="category">
          <img src="{{ asset('images/Product Image (1).png') }}" alt="Wood Waste">
          <h3>Wood Waste</h3>
        </div>
        <div class="category">
          <img src="{{ asset('images/Product Image (2).png') }}" alt="Fabric and Textile Waste">
          <h3>Fabric and Textile Waste</h3>
        </div>
      </div>
    </div>

    <!-- Popular Choices -->
    <div class="section">
      <h2>Popular Choices</h2>
      <p>Most sought-after products. Quality waste materials that have proven their value!</p>
      <button>View More</button>

      <div class="favorites">
        <div class="favorite-item">
          <img src="{{ asset('images/tekstil.png') }}" alt="Synthetic Leather Waste">
          <h3>Synthetic Leather Waste</h3>
          <p>Rp.28,000 / 1m</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleLeather</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.8 (100+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="{{ asset('images/Product Image (3).png') }}" alt="Used Glass Bottles">
          <h3>Used Glass Bottles</h3>
          <p>Rp.7,500 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleGlass</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.5 (50+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="{{ asset('images/Product Image (4).png') }}" alt="Ceramic Mosaic Remnants">
          <h3>Ceramic Mosaic Remnants</h3>
          <p>Rp.20,000 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleCeramics</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.9 (200+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- New Products -->
    <div class="section">
      <h2>New Products</h2>
      <p>Latest collection of selected waste materials. Discover the potential in recent waste!</p>
      <button>View More</button>

      <div class="favorites">
        <div class="favorite-item">
          <img src="{{ asset('images/tembaga.png') }}" alt="Used Copper Cables">
          <h3>Used Copper Cables</h3>
          <p>Rp.28,000 / 1m</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleCopper</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.8 (100+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="{{ asset('images/Product Image (5).png') }}" alt="Mixed Linen Fabric">
          <h3>Mixed Linen Fabric</h3>
          <p>Rp.7,500 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleFabric</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.5 (50+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>

        <div class="favorite-item">
          <img src="{{ asset('images/Product Image (6).png') }}" alt="Used Metal Can Lids">
          <h3>Used Metal Can Lids</h3>
          <p>Rp.20,000 / 1kg</p>
          <div class="favorite-info">
            <div class="market-info">
              <p>RecycleMetal</p>
              <img src="{{ asset('images/market.png') }}" alt="">
            </div>
            <div class="rating-info">
              <p>4.9 (200+)</p>
              <img src="{{ asset('images/star.png') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <hr>
      <div class="footer-content">
        <div class="footer-left">
          <h1>Sign Up for Updates</h1>
          <p>Be the first to know about new products and special offers.</p>
        </div>
        <div class="footer-right">
          <div class="about_us">
            <p class="about_us_title">About Us</p>
            <ul class="about_us_list"> 
              <li><a href="#">Our Story</a></li>
              <li><a href="#">Mission & Vision</a></li>
              <li><a href="#">Sustainability Principles</a></li>
              <li><a href="#">Partners & Community</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Media & Publications</a></li>
            </ul>
          </div>
          
          <div class="help">
            <p class="help_title">Help</p>
            <ul class="help_list">
              <li><a href="#">FAQ</a></li>
              <li><a href="#">How to Shop</a></li>
              <li><a href="#">Shipping Information</a></li>
              <li><a href="#">Return Policy</a></li>
              <li><a href="#">Terms of Service</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
        </div>
    </footer>
  </div>
</body>
</html>
