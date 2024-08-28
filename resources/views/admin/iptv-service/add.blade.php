@extends('layouts.admin')

@section('title', 'IPTV Services')
@section('page-title', 'IPTV Services')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.iptv.service.index') }}" class="text-muted text-hover-primary">IPTV Services</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Add Record</li>
    </ul>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add IPTV Service</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.iptv.service.save') }}" method="POST" class="add-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Logo</label>
                            <input type="file" name="logo" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Connection Type</label>
                            <select name="connection_type" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="single" {{ old('connection_type') == 'single' ? 'selected' : '' }}>Single Connection</option>
                                <option value="multi" {{ old('connection_type') == 'multi' ? 'selected' : '' }}>Multi Connection</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Duration</label>
                            <select name="duration" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="1" {{ old('duration') == '1' ? 'selected' : '' }}>1 Month</option>
                                <option value="3" {{ old('duration') == '3' ? 'selected' : '' }}>3 Months</option>
                                <option value="6" {{ old('duration') == '6' ? 'selected' : '' }}>6 Months</option>
                                <option value="12" {{ old('duration') == '12' ? 'selected' : '' }}>12 Months</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. IPTV Serives" value="{{ old('title') }}"
                            />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="e.g. 250" value="{{ old('price') }}"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Short Description</label>
                            <textarea name="short_desc" class="form-control" rows="3" placeholder="Write short description">{{ old('short_desc') }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Description</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Write description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select name="status" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.iptv.service.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/iptv-services/add.js?v='.rand()) }}"></script>
@endsection
