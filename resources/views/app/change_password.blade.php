@extends('layouts.app')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

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
                            <form action="{{ route('store.change.password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="********" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="*******" value="" required>
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
