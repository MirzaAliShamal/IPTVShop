@extends('layouts.admin')

@section('title', 'Gift Cards')
@section('page-title', 'Gift Cards')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.gift.card.index') }}" class="text-muted text-hover-primary">Gift Card</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Edit Gift Card</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Edit Gift Card</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.gift.card.update', $giftCard->id) }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Link</label>
                            <input type="text" name="link" class="form-control" placeholder="e.g. https://link.com" value="{{ old('link', $giftCard->link) }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="e.g. 250" value="{{ old('amount', $giftCard->amount) }}"/>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.gift.card.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/gift-card/edit.js?v='.rand()) }}"></script>
@endsection
