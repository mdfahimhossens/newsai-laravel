<header class="landing-top-bar" style="background-color: #111;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-6">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('website/img/logo.png') }}" alt="oneNews">
                    </a>
                </div>
            </div>
            <div class="col-6">
               <div class="landing-top-buttons text-end">
        @guest
            <a href="{{ route('login') }}" class="text-white text-decoration-none me-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary text-decoration-none">Sign Up</a>
        @endguest

        @auth
            <a href="#" class="text-white text-decoration-none">
                {{ Auth::user()->name }}
            </a>
        @endauth
            </div>
            </div>
        </div>
    </div>
</header>
