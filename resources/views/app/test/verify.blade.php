@extends('layouts.app')

@section('title', 'Verify Email')
@section('page-title', 'Verify Email')

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
                            <p class="mt-3">Verify Your Email Address Please enter the email address you used to register with us.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-12 text-center">
                            <form action="{{ route('test.store.verify') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ Auth::user()->email }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group text-center justify-content-center">
                                    <button type="submit" class="btn btn-primary m-auto">Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
