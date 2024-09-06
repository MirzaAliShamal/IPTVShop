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
                            <h3 class="mb-3">Great! To add €{{ $fund->amount }} to your TopIPTVShop account, make a payment.</h3>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="card-light">
                                <div class="card-body">
                                    <form action="{{ route('funds.card.payment', $fund->id) }}" class="payment-form" method="POST">
                                        @csrf
                                        <input type="hidden" name="method" value="visa">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input
                                                        type="text" class="form-control" name="name"
                                                        placeholder="Card Holder Name" autocomplete="off"
                                                        maxlength="20" required
                                                    >
                                                    </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group card-form-group">
                                                    <input
                                                        type="text" class="form-control" name="number" id="cardnumber"
                                                        placeholder="Card Number"
                                                        inputmode="numeric" required
                                                    >
                                                    <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"></svg>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-group">
                                                    <input
                                                        type="text" class="form-control" name="expiry" id="expirationdate"
                                                        placeholder="Expiration (mm/yy)"
                                                        inputmode="numeric" required
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-group">
                                                    <input
                                                        type="text" class="form-control" name="cvv" id="securitycode"
                                                        placeholder="Security Code"
                                                        inputmode="numeric" required
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-center mb-0">
                                            <button type="submit" class="btn btn-primary w-100">Pay</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
    <script src="{{ asset('app/js/card.js?v='.rand()) }}"></script>
@endsection
