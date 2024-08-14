@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.setting.index') }}" class="text-muted text-hover-primary">Settings</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Update Settings</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>PayPal Funds Setting</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">PayPal Email</label>
                            <input type="text" name="paypal_email" class="form-control" placeholder="e.g. example@paypal.com" value="{{ setting('paypal_email') }}"/>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Visa Funds Setting</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Full Name</label>
                            <input type="text" name="visa_full_name" class="form-control" placeholder="e.g. John Doe" value="{{ setting('visa_full_name') }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">IBAN</label>
                            <input type="text" name="visa_iban" class="form-control" placeholder="e.g. John Doe" value="{{ setting('visa_iban') }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Bic</label>
                            <input type="text" name="visa_bic" class="form-control" placeholder="e.g. John Doe" value="{{ setting('visa_bic') }}"/>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
