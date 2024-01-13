<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="laracamp logo">
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link ps-0 active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-0" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-0" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ps-0" href="#">Business</a>
                </li> --}}
            </ul>
            @auth
                <div class="d-flex user-logged nav-item dropdown">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>
                            Halo, {{ explode(' ', Auth::user()->name)[0] }}!
                        </span>

                        {{-- avatar --}}
                        @if (!Auth::user()->is_admin)
                            <img src="{{ Auth::user()->avatar }}"
                                class="user-photo rounded-circle d-none d-lg-inline"
                                alt="avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name=Admin"
                                class="user-photo rounded-circle d-none d-lg-inline"
                                alt="avatar">
                        @endif

                        {{-- dropdown --}}
                        <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a href="{{ route(Auth::user()->is_admin ? 'admin.dashboard' : 'user.dashboard') }}"
                                    class="dropdown-item">
                                    My Dashboard
                                </a>
                            </li>
                            @if (Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.discount.index') }}" class="dropdown-item">Discount</a>
                                </li>
                            @endif
                            <li>
                                <a href="#"
                                    class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    Sign Out
                                </a>
                                <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @else
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-primary">
                        Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
