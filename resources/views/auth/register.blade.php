@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')

<style>
    .input-field input {
        padding: 10px 16px;
    }
</style>

<section class="signin_layouts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sing-in-form">
                    <form class="auth-form sign-in-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <h3>Create your account</h3>
                        <p class="auth-subheading">Sign up to start your newsletter.</p>

                        <div class="input-field">
                            <input type="text" name="username" maxlength="50" placeholder="Username" value="{{ old('username') }}">
                            @error('username') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="input-field">
                            <input type="email" name="email" maxlength="50" placeholder="Email Address" value="{{ old('email') }}" required>
                            @error('email') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="input-field">
                            <input type="text" name="fname" maxlength="50" placeholder="First Name" value="{{ old('fname') }}">
                            @error('fname') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="input-field">
                            <input type="text" name="lname" maxlength="50" placeholder="Last Name" value="{{ old('lname') }}">
                            @error('lname') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="password_wrapper">
                            <input type="password" name="password" id="password" placeholder="Create a Password">
                            @error('password') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="password_wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password">
                            @error('password_confirmation') <small>{{ $message }}</small> @enderror
                        </div>

                        <button type="submit" class="login_btn">Create account</button>

                        <p class="spam-note">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            Secure and private. We never share your data.
                        </p>

                        <p class="login_link">
                            Already have an account?
                            <a href="{{ route('login') }}">Sign in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.input-field input, .password_wrapper input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const error = this.parentElement.querySelector('small');
            if (error) error.style.display = 'none';
        });
    });
});
</script>

@endsection
