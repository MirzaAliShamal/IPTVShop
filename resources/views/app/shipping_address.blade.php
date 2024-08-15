@extends('layouts.app')

@section('title', 'Shipping Address')
@section('page-title', 'Shipping Address')

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
                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-12 text-center">
                            <form action="{{ route('store.shipping.address') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="address" class="form-control" rows="5" placeholder="Full Address" required>{{ Auth::user()->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="zipcode" class="form-control" placeholder="Zipcode" value="{{ Auth::user()->zipcode }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="region" class="form-control" placeholder="Region" value="{{ Auth::user()->region }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="country" class="form-control" placeholder="Country" value="{{ Auth::user()->country }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ Auth::user()->city }}" required>
                                </div>
                                <div class="form-group text-center justify-content-center">
                                    <button type="submit" class="btn btn-primary m-auto">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
