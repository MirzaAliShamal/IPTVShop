@extends('layouts.admin')

@section('title', 'PayPal Multiples')
@section('page-title', 'PayPal Multiples')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.paypal.multiple.index') }}" class="text-muted text-hover-primary">PayPal Multiples</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Edit Record</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Edit PayPal</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.paypal.multiple.update', $paypal->id) }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="e.g. 250" value="{{ old('amount', $paypal->amount) }}" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Link</label>
                            <div id="link-container">
                                @foreach($paypal->links as $link)
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="links[{{$link->id}}][id]" value="{{ $link->id }}">
                                        <input type="text" name="links[{{$link->id}}][link]" class="form-control" placeholder="https://example.com" value="{{ $link->link }}" autocomplete="off" />
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary add-link">Add</button>
                                            <button type="button" class="btn btn-danger remove-link">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.paypal.multiple.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/paypal-multiple/edit.js?v='.rand()) }}"></script>
@endsection
