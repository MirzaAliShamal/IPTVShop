@extends('layouts.app')

@section('title', 'Add Funds')
@section('page-title', 'Add Funds')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center" id="pills-tab" role="tablist">
                        <div class="col-12 text-center mb-3">
                            <h2 class="section-title">Select your payment method</h2>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="payment-methods active giftcard-method" id="pills-giftcard-tab" data-bs-toggle="pill" data-bs-target="#pills-giftcard" type="button" role="tab" aria-controls="pills-giftcard" aria-selected="true">
                                <img src="{{ asset('app/images/giftcard.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="payment-methods paypal-method" id="pills-paypal-tab" data-bs-toggle="pill" data-bs-target="#pills-paypal" type="button" role="tab" aria-controls="pills-paypal" aria-selected="false">
                                <img src="{{ asset('app/images/paypal.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="payment-methods visa-method" id="pills-visa-tab" data-bs-toggle="pill" data-bs-target="#pills-visa" type="button" role="tab" aria-controls="pills-visa" aria-selected="false">
                                <img src="{{ asset('app/images/visa.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-content mt-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-giftcard" role="tabpanel" aria-labelledby="pills-giftcard-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-9 col-12 text-center mb-4">
                                            <p>Top up your account with our gift cards from eBay and Etsy. Redeem them on our platform to add funds securely. They also make great gifts for friends and family</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        @foreach ($giftCards as $giftcard)
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                <div class="funds-card gift-card">
                                                    <div class="funds-logo">
                                                        <img src="{{ asset('app/images/giftcard.png') }}" alt="">
                                                    </div>
                                                    <span class="funds-price">{{ $giftcard->amount }}€</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-paypal" role="tabpanel" aria-labelledby="pills-paypal-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-9 col-12 text-center mb-4">
                                            <p>Select the amount you want and click on continue</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        @foreach ($paypalCards as $paypalCard)
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                <a href="{{ route('funds.paypal', $paypalCard->id) }}" class="d-block">
                                                    <div class="funds-card gift-card">
                                                        <div class="funds-logo">
                                                            <img src="{{ asset('app/images/paypal-icon.png') }}" alt="">
                                                        </div>
                                                        <span class="funds-price">{{ $paypalCard->amount }}€</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-visa" role="tabpanel" aria-labelledby="pills-visa-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-9 col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-9 col-12 text-center mb-4">
                                            <p>Select the amount you want and click on continue</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        @foreach ($visaCards as $visaCard)
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                <a href="{{ route('funds.visa', $visaCard->id) }}" class="d-block">
                                                    <div class="funds-card gift-card">
                                                        <div class="funds-logo">
                                                            <img src="{{ asset('app/images/visa-card.png') }}" alt="">
                                                        </div>
                                                        <span class="funds-price">{{ $visaCard->amount }}€</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
