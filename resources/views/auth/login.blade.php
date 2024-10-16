@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
<div class="container min-h-100">
    <div class="row min-h-100 justify-content-between align-items-center">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="auth-form">
                <div class="auth-form-header">
                    <h2>WELCOME BACK</h2>
                    <p>Welcome back! Please enter your details.</p>
                </div>
                <div class="auth-form-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter your email" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" autocomplete="off">
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Google Recaptcha Widget-->
                            <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey={{ config('services.recaptcha.key') }}></div>
                            @error('g-recaptcha-response')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                        {{-- <div class="form-group d-flex gap-2">
                            <a href="{{ route('auth.socialite.redirect', 'google') }}" class="btn btn-social w-100">
                                <img src="{{ asset('app/images/google.svg') }}" width="25px" class="img-fluid" alt="">
                                Signin with Google
                            </a>
                            <a href="{{ route('auth.socialite.redirect', 'facebook') }}" class="btn btn-social w-100">
                                <img src="{{ asset('app/images/facebook.svg') }}" width="15px" class="img-fluid" alt="">
                                Signin with Facebook
                            </a>
                        </div> --}}
                    </form>
                </div>
                <div class="auth-form-footer">
                    <p>Don’t have an account? <a href="{{ route('register') }}" class="text-primary">Sign up fo free!</a></p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="auth-image">
                <img src="{{ asset('app/images/signin-page.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script async src="https://www.google.com/recaptcha/api.js"></script>
@endsection
