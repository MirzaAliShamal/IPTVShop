@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
<div class="container min-h-100">
    <div class="row min-h-100 justify-content-between align-items-center">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="auth-form">
                <div class="auth-form-header">
                    <h2>CREATE ACCOUNT</h2>
                    <p>Register yourself! Please enter your details.</p>
                </div>
                <div class="auth-form-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter your name" autocomplete="off">
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Enter your username" autocomplete="off">
                            @error('username')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
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
                            <button type="submit" class="btn btn-primary w-100">Sign up</button>
                        </div>
                    </form>
                </div>
                <div class="auth-form-footer">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Sign in to your account!</a></p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="auth-image">
                <img src="{{ asset('app/images/signup-page.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
