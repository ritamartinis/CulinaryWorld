<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand ms-3" href="/">Culinary World</a>
            <div class="d-flex ms-auto align-items-center">
                <a class="nav-link me-3" href="/">Home</a>
                @guest
                    <a class="nav-link me-3" href="/login">Login</a>
                    <a class="nav-link me-3" href="/register">Register</a>
                    @else
                <span class="nav-link me-3">Welcome, {{ Auth::user()->name }}</span>
                <a class="nav-link me-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">My Profile</a>
                </li>
                <hr>
                @if(Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.recipes') }}">Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments') }}">Comments</a>
                    </li>
                    <hr>
                @endif
            @endauth

                <a class="nav-link" href="{{ route('recipes') }}">Recipes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories') }}">Categories</a>
            </li>
        </ul>
        <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search for a recipe" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
</div>
