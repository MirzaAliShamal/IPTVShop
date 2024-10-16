@extends('layouts.app')

@section('title', 'Verify OTP')
@section('page-title', 'Verify OTP')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-12 text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('app/images/iptv-shop-icon-green.png') }}" class="img-fluid" alt="">
                            </div>
                            <p class="mt-5">A verification code has been sent to {{ auth()->user()->email }}</p>
                            <p class="mt-3">
                                Please check your inbox and spam box and enter verification code below to verify your email address. The code will expire in 15 minutes
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-12 text-center">
                            <div class="auth-form-body">
                                <form action="{{ route('test.store.otp') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="otp-form-group @error('otp') is-invalid @enderror">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                            <input type="text" name="otp[]" minlength="1" maxlength="1" class="form-control otp-inputbar" autocomplete="off">
                                        </div>
                                        @error('otp')
                                            <div class="invalid-feedback mt-3">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('test.resend') }}" class="forgot-password">Resend code</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
