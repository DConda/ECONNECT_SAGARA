<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Econnect')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Add Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>
<body class="bg-gray-100">
    <nav class="bg-green-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-xl font-semibold hover:text-green-200">
                        Econnect
                    </a>
                    @auth
                        <div class="hidden md:flex items-center space-x-6">
                            <a href="{{ route('home') }}" class="hover:text-green-200 {{ request()->routeIs('home') ? 'text-green-200' : '' }}">
                                Home
                            </a>
                            <a href="{{ route('catalog') }}" class="hover:text-green-200 {{ request()->routeIs('catalog') ? 'text-green-200' : '' }}">
                                Catalog
                            </a>
                            <a href="{{ route('favorites') }}" class="hover:text-green-200 {{ request()->routeIs('favorites') ? 'text-green-200' : '' }}">
                                Favorites
                            </a>
                            <a href="{{ route('cart') }}" class="hover:text-green-200 {{ request()->routeIs('cart') ? 'text-green-200' : '' }}">
                                Cart
                            </a>
                            <a href="{{ route('orders') }}" class="hover:text-green-200 {{ request()->routeIs('orders') ? 'text-green-200' : '' }}">
                                Order History
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-green-200">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-green-200">Register</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:text-green-200">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
