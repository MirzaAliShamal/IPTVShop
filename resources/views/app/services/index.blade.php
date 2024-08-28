@extends('layouts.app')

@section('title', 'Popular Services')
@section('page-title', 'Popular Services')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-3">
                            <h2 class="section-title">Subscribe for Exclusive Benefits</h2>
                        </div>

                        @foreach ($services as $s)
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="section-card">
                                    <div class="section-top d-flex flex-column justify-content-center align-items-center gap-3">
                                        @if ($s->duration > 1)
                                                <h3 class="text-center">{{ $s->duration.' Months' }}</h3>
                                            @else
                                                <h3 class="text-center">{{ $s->duration.' Month' }}</h3>
                                            @endif
                                        <div class="section-logo">
                                            <img src="{{ Storage::url($s->logo) }}" alt="Logo">
                                        </div>
                                    </div>
                                    <div class="section-body d-flex flex-column justify-content-center align-items-center gap-3">
                                        <span class="section-price">{{ $s->price.'€' }}</span>
                                        <a href="{{ route('services.view', $s->id) }}" class="btn btn-secondary">Buy Now</a>
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
