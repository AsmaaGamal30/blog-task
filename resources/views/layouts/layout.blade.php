<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>
    @vite(['resources/css/index.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <a href="{{ route('home') }}">
            <h1>My Blog</h1>
        </a>
        <div class="header-left">
            @if (Auth::check())
                <form action="{{ route('post.create') }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn">Create a Post</button>
                </form>

                <form action="{{ route('profile') }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn">Manage Profile</button>
                </form>
            @endif

            <form action="{{ route('posts.search') }}" method="GET" style="display:inline;">
                <input type="text" name="search" placeholder="Search posts" required>
                <button type="submit" class="btn">Search</button>
            </form>
            </form>

        </div>
        <div class="header-right">
            @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            @endif
            @if (!Auth::check())
                <form action="{{ route('login') }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn">Login</button>
                </form>
                <form action="{{ route('register') }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn">Register</button>
                </form>
            @endif
        </div>
    </header>
    <main>

        @yield('content')
    </main>
    <footer>
        <p>&copy; 2024 My Blog. All rights reserved.</p>
    </footer>

</body>

</html>
