@extends('layouts.app')

@section('title', 'Buy IPTV Services')
@section('page-title', 'Buy IPTV Services')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        @if (count($singleServices) > 0)
                            <div class="col-12 text-center mb-3">
                                <h2 class="section-title">Single Connection</h2>
                            </div>

                            @foreach ($singleServices as $ss)
                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="section-card">
                                        <div class="section-top d-flex flex-column justify-content-center align-items-center gap-3">
                                            <h3 class="text-center">{{ $ss->duration.' Month' }}</h3>
                                            <div class="section-logo">
                                                <img src="{{ Storage::url($ss->logo) }}" alt="Logo">
                                            </div>
                                        </div>
                                        <div class="section-body d-flex flex-column justify-content-center align-items-center gap-3">
                                            <span class="section-price">{{ $ss->price.'£' }}</span>
                                            <a href="" class="btn btn-secondary">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if (count($multiServices) > 0)
                            <div class="col-12 text-center mb-3">
                                <h2 class="section-title">Multi Connection</h2>
                            </div>

                            @foreach ($multiServices as $ms)
                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="section-card">
                                        <div class="section-top d-flex flex-column justify-content-center align-items-center gap-3">
                                            <h3 class="text-center">{{ $ms->duration.' Month' }}</h3>
                                            <div class="section-logo">
                                                <img src="{{ Storage::url($ms->logo) }}" alt="Logo">
                                            </div>
                                        </div>
                                        <div class="section-body d-flex flex-column justify-content-center align-items-center gap-3">
                                            <span class="section-price">{{ $ms->price.'£' }}</span>
                                            <a href="" class="btn btn-secondary">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
