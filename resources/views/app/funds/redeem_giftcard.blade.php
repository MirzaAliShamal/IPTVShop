@extends('layouts.app')

@section('title', 'Redeem Gift Card')
@section('page-title', 'Redeem Gift Card')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 col-12 text-center">
                            <h3 class="mb-3">Great! To redeem your giftcard, please submit the following information.</h3>
                            <p class="mb-3">Your ebay/etsy profile url and the giftcard code here.</p>
                            <p>This will help us fulfill your order promptly.</p>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="card-light">
                                <div class="card-body">
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_link" placeholder="Your Ebay/Etsy Link" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="code" placeholder="Your Giftcard Code" autocomplete="off" required>
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
