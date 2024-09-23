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
                            <h3 class="mb-3">{!! nl2br(e(wireTitle($fund->amount))) !!}</h3>
                            <div class="d-flex flex-column mb-3">
                                <p><strong class="text-primary">Full Name:</strong> {{ $bankAccount->name }}</p>
                                <p><strong class="text-primary">IBAN:</strong> {{ $bankAccount->iban }}</p>
                                <p><strong class="text-primary">Bic:</strong> {{ $bankAccount->bic }}</p>
                            </div>
                            <p>After completing the payment, kindly provide your full name and the Iban used for the transfer . This will help us fulfill your order promptly.</p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="card-light">
                                <div class="card-body">
                                    <form action="{{ route('funds.wire.purchase', $fund->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="method" value="visa">
                                        <input type="hidden" name="bank_account_id" value="{{ $bankAccount->id }}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="full_name" placeholder="Your Full Name" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="visa_iban" placeholder="Your Account IBAN" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="visa_email" placeholder="Your Account Email" autocomplete="off" value="{{ Auth::user()->email }}" required>
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
                        <div class="col-lg-1 col-md-1 col-sm-3 col-3">
                            <a href="{{ route('funds.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
