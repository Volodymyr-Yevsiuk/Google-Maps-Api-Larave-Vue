<div class="navBar">
    <div class="logo">
        <a href="{{ route('home') }}" class="nav_link home_nav_link">Google Maps Project</a>
    </div>

    @if (Route::has('login'))
        @auth
            <div class="authoriazed_routes">
                <a href="{{ route('admin') }}" class="nav_link">Admin Panel</a>
                <a href="{{ route('logout') }}" class="nav_link">Logout</a>
            </div>
        @else
            <div class="auth_routes">
                <a href="{{ route('login') }}" class="nav_link">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav_link">Register</a>
                @endif
            </div>
        @endauth
    @endif
</div>
