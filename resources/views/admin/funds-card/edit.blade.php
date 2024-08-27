@extends('layouts.admin')

@section('title', 'Edit Funds Card')
@section('page-title', 'Edit Funds Card')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.funds.card.paypal') }}" class="text-muted text-hover-primary">Funds Card</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Edit Funds Card</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Edit Funds Card</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.funds.card.update', $fundsCard->id) }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Type</label>
                            <select name="type" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="paypal" {{ old('type', $fundsCard->type) == '3' ? 'selected' : '' }}>PayPal</option>
                                <option value="visa" {{ old('type', $fundsCard->type) == '6' ? 'selected' : '' }}>Visa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="e.g. 250" value="{{ old('amount', $fundsCard->amount) }}"/>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.funds.card.paypal') }}" class="btn btn-secondary">
                            Go Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var laravelErrors = {!! $errors->toJson() !!};
    </script>
    <script src="{{ asset('admin/js/services/add.js?v='.rand()) }}"></script>
@endsection
