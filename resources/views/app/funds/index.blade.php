@extends('layouts.app')

@section('title', 'Add Funds')
@section('page-title', 'Add Funds')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-3">
                            <h2 class="section-title">Select your payment method</h2>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3 flex-wrap mb-3">
                        @if (setting('paypal_multiple_status') == 'active')
                            <a href="{{ route('funds.paypals.index') }}" class="payment-methods paypal-method @routeis('funds.paypals.index') active @endrouteis">
                                <img src="{{ asset('app/images/paypal.png?v='.rand()) }}" class="img-fluid" alt="">
                            </a>
                        @endif
                        @if (setting('paypal_status') == 'active')
                            <a href="{{ route('funds.paypal.index') }}" class="payment-methods paypal-method @routeis('funds.paypal.index') active @endrouteis">
                                <img src="{{ asset('app/images/paypal.png?v='.rand()) }}" class="img-fluid" alt="">
                            </a>
                        @endif
                        @if (setting('wire_status') == 'active')
                            <a href="{{ route('funds.wire.index') }}" class="payment-methods wire-method @routeis('funds.wire.index') active @endrouteis">
                                <img src="{{ asset('app/images/wire-transfer.png?v='.rand()) }}" class="img-fluid" alt="">
                            </a>
                        @endif
                        @if (setting('visa_status') == 'active')
                            <a href="{{ route('funds.visa.index') }}" class="payment-methods visa-method @routeis('funds.visa.index') active @endrouteis">
                                <img src="{{ asset('app/images/visa.png?v='.rand()) }}" class="img-fluid" alt="">
                            </a>
                        @endif
                    </div>

                    @yield('funds-content')
                </div>
            </div>
        </div>
    </div>
@endsection
