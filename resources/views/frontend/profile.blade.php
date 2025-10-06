@extends('frontend.layouts.app')
@section('title', 'My Profile')
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
                    <div class="news_name mt-3 me-3"></div>
                    <div class="user-menu">
                        <button type="button" class="user-icon avatar" aria-label="User menu">
                            @if(Auth::user() && Auth::user()->profile_image)
                                <img src="{{ asset(Auth::user()->profile_image) }}" 
                                     alt="profile" 
                                     style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                            @else
                                <svg viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                                </svg>
                            @endif
                        </button>
                        <ul class="users-menu">
                            <li><a href="{{ route('profile.show') }}">Profile</a></li>
                            <li><a href="{{ route('newsletter.edit') }}">Settings</a></li>
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

<section class="profile-container scroll-frame">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <a class="edition-open-link back-link mt-3" aria-label="Home" href="{{ route('newsletter.index') }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="12 8 8 12 12 16"></polyline>
                        <line x1="16" y1="12" x2="8" y2="12"></line>
                    </svg>
                </a>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden field for remove photo -->
                    <input type="hidden" name="remove_photo" id="removePhotoField" value="0">

                    <!-- Avatar -->
                    <div class="profile-avatar-field">
                        <div class="photo-menu">
                            <div class="profile-avatar avatar" aria-label="Upload or change your profile photo">
                                @if(Auth::user()->profile_image && file_exists(public_path(Auth::user()->profile_image)))
                                    <img id="avatarPreview" 
                                        src="{{ asset(Auth::user()->profile_image) }}" 
                                        alt="Avatar" 
                                        style="width:95px; height:95px; border-radius:50%; object-fit:cover;">
                                @else
                                    <svg id="defaultAvatar" viewBox="0 0 24 24" width="95px" height="95px" fill="none" 
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                                    </svg>
                                @endif
                            </div>

                            <ul class="profile-menu avatar-dropdown">
                                <li>
                                    <label style="cursor:pointer;" class="upload_img">
                                        Upload photo
                                        <input type="file" name="profile_image" id="profileImageInput" accept="image/*" style="display:none;">
                                    </label>
                                </li>
                                <li>
                                    <button type="button" id="removePhotoBtn">Remove photo</button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Profile Fields -->
                    <div class="profile-field">
                        <label class="profile-label">Username</label>
                        <input class="dashed-input profile-input" name="username" maxlength="50" value="{{ old('username', Auth::user()->username) }}">
                        <p class="char-count" translate="no">{{ strlen(Auth::user()->username) }}/50</p>
                    </div>
                    <div class="profile-field">
                        <label class="profile-label">Email address</label>
                        <input class="dashed-input profile-input" name="email" maxlength="50" value="{{ old('email', Auth::user()->email) }}">
                        <p class="char-count" translate="no">{{ strlen(Auth::user()->email) }}/50</p>
                    </div>
                    <div class="profile-field">
                        <label class="profile-label">Password</label>
                        <input type="password" name="password" class="dashed-input profile-input" readonly="" value="**********">
                        <p class="char-count forgot-password-link"><a href="">Forgot your password?</a></p>
                    </div>
                    <div class="profile-field">
                        <label class="profile-label">First name</label>
                        <input class="dashed-input profile-input" name="fname" maxlength="50" value="{{ old('fname', Auth::user()->fname) }}">
                        <p class="char-count" translate="no">{{ strlen(Auth::user()->fname) }}/50</p>
                    </div>
                    <div class="profile-field">
                        <label class="profile-label">Last name</label>
                        <input class="dashed-input profile-input" name="lname" maxlength="50" value="{{ old('lname', Auth::user()->lname) }}">
                        <p class="char-count" translate="no">{{ strlen(Auth::user()->lname) }}/50</p>
                    </div>

                    <div class="profile-field">
                        <div class="profile-actions">
                            <button type="button" class="cancel-button">Cancel</button>
                            <button type="submit">Save changes</button>
                        </div>
                    </div>
                    <div class="profile-field">
                        <p class="delete-account-link">Delete account</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const profileAvatar = document.querySelector('.profile-avatar');
    const profileMenu = document.querySelector("ul.profile-menu");
    const input = document.getElementById("profileImageInput");
    const preview = document.getElementById("avatarPreview");
    const defaultAvatar = document.getElementById("defaultAvatar");
    const removeBtn = document.getElementById("removePhotoBtn");
    const removeField = document.getElementById("removePhotoField");
    const userIcon = document.querySelector(".user-icon");
    const usersMenu = document.querySelector("ul.users-menu");

    // toggle users menu
    userIcon.addEventListener("click", () => {
        usersMenu.classList.toggle("show");
    });

    // toggle profile dropdown
    profileAvatar.addEventListener('click', () => {
        profileMenu.classList.toggle("show");
    });

    // Character count
    document.querySelectorAll(".profile-input").forEach(inputField => {
        const counter = inputField.closest(".profile-field").querySelector(".char-count");
        inputField.addEventListener("input", () => {
            counter.textContent = `${inputField.value.length}/${inputField.maxLength}`;
        });
    });

    // preview image
    input.addEventListener("change", e => {
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = ev => {
                if(preview){
                    preview.src = ev.target.result;
                } else {
                    let img = document.createElement("img");
                    img.id = "avatarPreview";
                    img.src = ev.target.result;
                    img.style = "width:80px; height:80px; border-radius:50%; object-fit:cover;";
                    profileAvatar.innerHTML = "";
                    profileAvatar.appendChild(img);
                }
                if(defaultAvatar) defaultAvatar.style.display = "none";
                removeField.value = "0"; // reset remove flag if new image uploaded
            };
            reader.readAsDataURL(file);
        }
    });

    // remove photo
    removeBtn.addEventListener("click", () => {
        input.value = ""; // clear file input
        removeField.value = "1"; // mark to remove

        if(preview){
            preview.remove();
        }
        if(defaultAvatar){
            defaultAvatar.style.display = "block";
        }
    });
});
</script>

@endsection
