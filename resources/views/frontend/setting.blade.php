@extends('frontend.layouts.app')
@section('title', 'Edit Newsletter')
@section('content')

<style>
body.body-bg {
    background: #fff;
}
</style>

{{-- Custom Header --}}
@section('customHeader')
<header class="landing-top-bar" style="background-color: #111;">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-6">
                <div class="logo">
                    <a href="{{ route('newsletter.index') }}">
                        <img src="{{ asset('website/img/logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="news_profile">
                    <div class="news_name mt-3 me-3">
                        <p class="newsletter-name" translate="no">{{ $newsletter->title }}</p>
                    </div>
                    <div class="user-menu">
                        <button type="button" class="user-icon avatar" aria-label="User menu">
                            @if(Auth::user() && Auth::user()->profile_image)
                                <img src="{{ asset(Auth::user()->profile_image) }}" 
                                     alt="profile" 
                                     style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                            @else
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 
                                    1.79-4 4 1.79 4 4 4z"></path>
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                                </svg>
                            @endif
                        </button>
                        <ul class="users-menu">
                            <li><a href="{{ route('profile.show') }}">Profile</a></li>
                            <li><a href="{{ route('newsletter.edit', $newsletter->id) }}">Settings</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Sign Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

<!-- newsletter start -->
<section class="newsletter-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <form class="create-form" method="POST" action="{{ route('newsletter.update', $newsletter->id) }}">
                    @csrf    
                    @method('PUT')

                    <!-- Newsletter Name -->
                    <div class="feild-group feild-editor">
                        <p class="day-info">What do you want to call your newsletter?</p>
                        <textarea name="title" class="dashed-input title-input" placeholder="Newsletter name" maxlength="50" rows="1">{{ old('title', $newsletter->title) }}</textarea>
                        <p class="char-count" translate="no">{{ strlen($newsletter->title) }}/50</p>
                    </div>

                    <!-- Newsletter Frequency -->
                    <div class="feild-group">
                        <p class="day-info">Which days do you want to receive your newsletter?</p>
                        <div class="day-buttons">
                            <select name="days" id="days" class="form-control">
                                <option value="">Select option</option>
                                <option value="daily" {{ $newsletter->days == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ $newsletter->days == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section name & description -->
                    <div class="field-group section-header mt-3">
                        <p class="day-info">How do you want to structure your newsletter?</p>
                    </div>

                    <div class="field-group section-field-group mt-3">
                        <textarea name="section_name" class="dashed-input section-name-input" placeholder="Section name" maxlength="50" rows="1">{{ old('section_name', $newsletter->section_name) }}</textarea>
                        <p class="char-count" translate="no">{{ strlen($newsletter->section_name) }}/50</p>

                        <textarea name="section_description" class="dashed-input section-description-input" placeholder="Section description" maxlength="500" rows="1">{{ old('section_description', $newsletter->section_description) }}</textarea>
                        <p class="char-count" translate="no">{{ strlen($newsletter->section_description) }}/500</p>
                    </div>

                    <!-- Buttons -->
                    <div class="profile-actions tight-gap mt-4">
                        <a href="{{ route('newsletter.show', $newsletter->id) }}" class="cancel-button">Cancel</a>
                        <button type="submit">Save changes</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.querySelector(".user-icon");
    const usersMenu = document.querySelector("ul.users-menu");

    if (userIcon && usersMenu) {
        userIcon.addEventListener("click", (e) => {
            e.stopPropagation();
            usersMenu.classList.toggle("show");
        });
    }

    document.addEventListener("click", () => {
        usersMenu?.classList.remove("show");
    });

    // Character Counter
    document.querySelectorAll("textarea[maxlength]").forEach(field => {
        const counter = field.closest(".feild-group, .field-group, .section-field-group")
                            ?.querySelector(".char-count");
        if (!counter) return;
        counter.textContent = `${field.value.length}/${field.maxLength}`;
        field.addEventListener("input", () => {
            counter.textContent = `${field.value.length}/${field.maxLength}`;
        });
    });
});
</script>

@endsection
