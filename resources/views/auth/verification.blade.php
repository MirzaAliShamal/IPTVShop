@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
<div class="container min-h-100">
    <div class="row min-h-100 justify-content-center align-items-center">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="auth-form">
                <div class="auth-form-header">
                    <h3>Verify your Email Address</h3>
                    <p>A verification code has been sent to jhon@gmail.com</p>
                    <p class="mt-5">
                        Please check your inbox and spam box and enter verification code below to verify your email address. The code will expire in 14:48
                    </p>
                </div>
                <div class="auth-form-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <div class="otp-form-group">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                <input type="text" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Verify</button>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('password.request') }}" class="forgot-password">Resend code</a>
                                <a href="{{ route('password.request') }}" class="forgot-password">Change email</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
