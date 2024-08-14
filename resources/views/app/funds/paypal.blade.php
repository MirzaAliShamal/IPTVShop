@extends('layouts.app')

@section('title', 'Add Funds')
@section('page-title', 'Add Funds')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 col-12 text-center">
                            <h3 class="mb-3">Great! To add €{{ $fund->amount }} to your TopIPTVShop account, please send €{{ $fund->amount }} to our PayPal at {{ $paypalEmail->email }}.</h3>
                            <p class="mb-3">After completing the payment, kindly provide your full name and the email address associated with your PayPal account here.</p>
                            <p>This will help us fulfill your order promptly.</p>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="card-light">
                                <div class="card-body">
                                    <form action="{{ route('funds.purchase', $fund->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="method" value="paypal">
                                        <input type="hidden" name="pay_pal_account_id" value="{{ $paypalEmail->id }}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="full_name" placeholder="Your Full Name" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="paypal_email" placeholder="Your PayPal Email" autocomplete="off" required>
                                        </div>
                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary w-100">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1">
                            <a href="{{ route('funds.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
