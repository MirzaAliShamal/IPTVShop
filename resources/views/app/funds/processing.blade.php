@extends('layouts.app')

@section('title', 'Processing Payment')
@section('page-title', 'Processing Payment')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-12 text-center">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <img src="{{ asset('app/images/iptv-shop-icon-green.png') }}" class="img-fluid" width="100px" alt="">
                            </div>
                            <h4 class="mb-5">Please stay on this page, payment is being verified.</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="progress-steps">
                                <span id="processing-step" class="progress-step active">Processing</span>
                                <span id="approval-step" class="progress-step">Approval</span>
                                <span id="complete-step" class="progress-step">Complete</span>
                            </div>
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="progress-content">
                                <div id="processing-tab" class="progress-pane show">
                                    <div class="text-center">
                                        <div class="spinner-border" style="width: 6rem; height: 6rem;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <p class="fw-bolder mb-3">Your top-up request is being processed!</p>
                                        <p>We’re preparing to add funds to your account. This will only take a moment.</p>
                                    </div>
                                </div>
                                <div id="approval-tab" class="progress-pane">
                                    <div class="text-center">
                                        <div class="spinner-border" style="width: 6rem; height: 6rem;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <p class="fw-bolder mb-3">Approval in Progress!</p>
                                        <p>Please check your bank account, as a request to approve this transaction has been sent to your bank and needs your approval.</p>
                                    </div>
                                </div>
                                <div id="complete-tab" class="progress-pane">
                                    <div id="completeMessage" class="complete-message" style="display:none;">
                                        <div class="text-center">
                                            <img src="{{ asset('app/images/accept.png') }}" width="120px" class="img-fluid" />
                                        </div>
                                        <div class="text-center mt-3">
                                            <p class="fw-bolder mb-3">Top-Up Complete!</p>
                                            <p>Your account has been successfully credited with the requested amount. Thank you for choosing our service!</p>
                                        
                                            <div class="d-flex flex-row justify-content-center mt-5">
                                                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Dashboard</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="failedMessage" class="complete-message" style="display:none;">
                                        <div class="text-center">
                                            <img src="{{ asset('app/images/decline.png') }}" width="120px" class="img-fluid" />
                                        </div>
                                        <div class="text-center mt-3">
                                            <p class="fw-bolder mb-3">Top-Up Failed!</p>
                                            <p>Unfortunately, your payment was not approved by the bank. Please check your payment details or try a different payment method. If the issue persists, contact our support team for assistance.</p>
                                        </div>
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
@section('js')
    <script>let steps = "{{ $transaction->steps }}"</script>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>
    <script src="{{ asset('app/js/processing.js?v='.rand()) }}"></script>
@endsection