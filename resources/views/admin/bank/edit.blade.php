@extends('layouts.admin')

@section('title', 'Bank Accounts')
@section('page-title', 'Bank Accounts')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.bank.account.index') }}" class="text-muted text-hover-primary">Bank Accounts</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Edit Bank Account</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Edit Bank Account</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.bank.account.update', $bank->id) }}" method="POST" class="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" value="{{ old('name', $bank->name) }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">IBAN</label>
                            <input type="text" name="iban" class="form-control" placeholder="e.g. 23434654664" value="{{ old('iban', $bank->iban) }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Bic</label>
                            <input type="text" name="bic" class="form-control" placeholder="e.g. 23432" value="{{ old('bic', $bank->bic) }}"/>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.bank.account.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/bank/edit.js?v='.rand()) }}"></script>
@endsection
