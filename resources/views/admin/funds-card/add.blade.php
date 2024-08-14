@extends('layouts.admin')

@section('title', 'Add Funds Card')
@section('page-title', 'Add Funds Card')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.funds.card.giftcard') }}" class="text-muted text-hover-primary">Funds Card</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Add Funds Card</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add Funds Card</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.funds.card.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Type</label>
                            <select name="type" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="giftcard" {{ old('type') == '1' ? 'selected' : '' }}>Giftcard</option>
                                <option value="paypal" {{ old('type') == '3' ? 'selected' : '' }}>PayPal</option>
                                <option value="visa" {{ old('type') == '6' ? 'selected' : '' }}>Visa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="e.g. 250" value="{{ old('amount') }}"/>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.funds.card.giftcard') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/funds-card/add.js?v='.rand()) }}"></script>
@endsection
