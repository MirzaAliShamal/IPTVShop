@extends('layouts.admin')

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <span class="text-muted text-hover-primary">Settings</span>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Payment Methods</li>
    </ul>
@endsection

@section('content')
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title">
                <h3>PayPal</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select class="form-select" name="paypal_status">
                                <option selected>Select an option</option>
                                <option value="active" {{ setting('paypal_status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="disabled" {{ setting('paypal_status') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">
                                Title
                            </label>
                            <span class="text-muted fs-7">Note: Use {amount}, {email} to put dynamic words</span>
                            <textarea name="paypal_title" class="form-control" rows="5">{!! e(setting('paypal_title')) !!}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">
                                Description
                            </label>
                            <textarea name="paypal_description" class="form-control" rows="5">{!! e(setting('paypal_description')) !!}</textarea>
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
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title">
                <h3>PayPal Multiple</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select class="form-select" name="paypal_multiple_status">
                                <option selected>Select an option</option>
                                <option value="active" {{ setting('paypal_multiple_status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="disabled" {{ setting('paypal_multiple_status') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                            </select>
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
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title">
                <h3>Wire Transfer</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select class="form-select" name="wire_status">
                                <option selected>Select an option</option>
                                <option value="active" {{ setting('wire_status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="disabled" {{ setting('wire_status') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">
                                Title
                            </label>
                            <span class="text-muted fs-7">Note: Use {amount} to put dynamic words</span>
                            <textarea name="wire_title" class="form-control" rows="5">{!! e(setting('wire_title')) !!}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">
                                Description
                            </label>
                            <textarea name="wire_description" class="form-control" rows="5">{!! e(setting('wire_description')) !!}</textarea>
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
    <div class="card mb-5">
        <div class="card-header">
            <div class="card-title">
                <h3>Visa</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.setting.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select class="form-select" name="visa_status">
                                <option selected>Select an option</option>
                                <option value="active" {{ setting('visa_status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="disabled" {{ setting('visa_status') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">
                                Title
                            </label>
                            <span class="text-muted fs-7">Note: Use {amount} to put dynamic words</span>
                            <textarea name="visa_title" class="form-control" rows="5">{!! e(setting('visa_title')) !!}</textarea>
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
