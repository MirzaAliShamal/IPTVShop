@extends('layouts.app')

@section('title', 'Popular Products')
@section('page-title', 'Popular Products')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-3">
                            <h2 class="section-title">Popular Producs Details</h2>
                        </div>

                        @foreach ($products as $p)
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="section-card">
                                    <div class="section-top d-flex flex-column justify-content-center align-items-center gap-3">
                                        <div class="section-logo">
                                            <img src="{{ Storage::url($p->logo) }}" alt="Logo">
                                        </div>
                                        <h3 class="text-center">{{ $p->title }}</h3>
                                    </div>
                                    <div class="section-body d-flex flex-column justify-content-center align-items-center gap-3">
                                        <span class="section-price">{{ $p->price.'£' }}</span>
                                        <a href="{{ route('products.purchase', $p->id) }}" class="btn btn-secondary">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
