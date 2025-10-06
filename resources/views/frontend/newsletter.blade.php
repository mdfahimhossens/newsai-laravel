@extends('frontend.layouts.app')
@section('title', $newsletter->title)
@section('content')

    {{-- Custom Header --}}
    @section('customHeader')
     <header class="landing-top-bar" style="background-color: #111;">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col-6">
                    <div class="logo">
                      <a href="">
                            <img src="{{asset('website/img/logo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="news_profile">
                        <div class="news_name mt-3 me-3">
                            <p class="newsletter-name" translate="no">{{$newsletter->title}}</p>
                        </div>
                        <div class="user-menu">
                        <button type="button" class="user-icon avatar" aria-label="User menu">
                            @if(Auth::user() && Auth::user()->profile_image)
                                <img src="{{ asset(Auth::user()->profile_image) }}" 
                                     alt="profile" 
                                     style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                            @else
                                {{-- fallback icon --}}
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                                </svg>
                            @endif
                        </button>
                            <ul class="users-menu">
                                <li><a href="{{route('profile.show')}}">Profile</a></li>
                                <li><a href="{{ route('newsletter.edit', $newsletter->id) }}">Settings</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="">Sign Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </header>
    <!-- header end -->
     @endsection

<div class="bottom_bar"></div>

<section class="newsletter-create edition-view-layout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 g-0">
                <div class="edition-list-wrapper">
                    <ul class="edition-list">
                        <li class="edition-item">
                            <article class="edition-card edition-status">
                                <span class="edition-status-dot" style="background-color: rgb(96, 165, 250);"></span>
                                <span>Kicking off your edition! We’re recalling your interests...</span>
                                <p>Next publication: Today</p>
                            </article>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 g-0">
                <div class="edition-container empty">
                    <div class="edition-detail">
                        <span class="edition-status-dot" style="background-color: rgb(59, 130, 246);"></span>
                        We’re baking your first edition. It’ll be ready very soon...
                    </div>

                    {{-- ✅ Send Newsletter button এখানে --}}
                    <!-- <div class="mt-4">
            @if($newsletter->status !== 'sent')
                <form action="{{ route('newsletter.send', $newsletter->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Send Newsletter</button>
                </form>
            @endif
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.querySelector(".user-icon");
    const usersMenu = document.querySelector("ul.users-menu");

    userIcon.addEventListener("click", () => {
         usersMenu.classList.toggle("show");
    });
});
</script>
@endsection
