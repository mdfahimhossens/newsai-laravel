@extends('frontend.layouts.app')
@section('title', 'Login')
@section('content')

<style>
    .input-email input {
        padding: 10px 16px;
    }
</style>

    <section class="signin_layouts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sing-in-form">
                        <form class="auth-form sign-in-form" method="POST" action="{{ route('login') }}">
                            @csrf    
                        <h3>Welcome back</h3>
                            <p class="auth-subheading">Sign in to continue to your account.</p>
                            <div class="input-field input-email">
                                <input type="text" name="login" maxlength="50" placeholder="Email or username" value="{{ old('login') }}">
                                @error('login') <small>{{ $message }}</small> @enderror
                            </div>
                            <div class="pass_wrapper">
                           <div class="password_wrapper">
                                <input type="password" id="password" name="password" id="" placeholder="Password">
                                <button type="button" class="toggle-password" aria-label="Show or hide the password">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#ccc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </button>
                            </div>
                            <div class="message">
                               @error('password') <small>{{ $message }}</small> @enderror
                            </div>
                            </div>
                            <p class="forgot-link">Forgot your password?</p>
                            <button type="submit" class="login_btn">Sign in</button>
                            <p class="spam-note">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                Secure and private. We never share your data.
                            </p>
                            <p class="login_link">
                                Don’t have an account?
                                <a href="{{route('register')}}">Create one</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    @endsection
    
