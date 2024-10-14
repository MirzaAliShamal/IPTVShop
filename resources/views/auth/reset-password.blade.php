@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="container min-h-100">
    <div class="row min-h-100 justify-content-between align-items-center">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="auth-form">
                <div class="auth-form-header">
                    <h2>FORGOT YOUR PASSWORD?</h2>
                    <p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    @if (session('status'))
                        <div class="alert alert-success mt-3 text-start">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="auth-form-body">
                    <form action="{{ route('password.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $request->email) }}" placeholder="Enter your email" autocomplete="off">
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
                            <!-- Google Recaptcha Widget-->
                            <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror" data-sitekey={{ config('services.recaptcha.key') }}></div>
                            @error('g-recaptcha-response')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        </div>
                    </form>
                </div>
                <div class="auth-form-footer">
                    <p>Already an account? <a href="{{ route('login') }}" class="text-primary">Login Here!</a></p>
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
