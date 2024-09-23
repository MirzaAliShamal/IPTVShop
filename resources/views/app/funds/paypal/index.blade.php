@extends('app.funds.index')

@section('funds-content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-9 col-12">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12 text-center mb-4">
                <p>Select the amount you want and click on continue</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($cards as $card)
                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('funds.paypal.checkout', $card->id) }}" class="d-block">
                        <div class="funds-card gift-card">
                            <div class="funds-logo">
                                <img src="{{ asset('app/images/paypal-icon.png') }}" alt="">
                            </div>
                            <span class="funds-price">{{ $card->amount }}€</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
