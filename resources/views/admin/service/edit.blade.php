@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.iptv.service.index') }}" class="text-muted text-hover-primary">Services</a>
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
                <h3>Edit Service</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.service.update', $service->id) }}" method="POST" class="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        @if($service->logo)
                            <div class="d-flex flex-column mb-5">
                                <label class="form-label">Current Logo: <a href="{{ Storage::url($service->logo) }}" target="_blank" class="text-decoration-underline">{{ basename($service->logo) }}</a></label>
                                <div class="fs-7 fw-bold text-muted">Leave empty to keep the current logo</div>
                            </div>
                        @endif
                        <div class="form-group mb-5">
                            <label class="required form-label">Logo</label>
                            <input type="file" name="logo" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" placeholder="e.g. 1" value="{{ old('duration', $service->duration) }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. IPTV Serives" value="{{ old('title', $service->title) }}"
                            />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="e.g. 250" value="{{ old('price', $service->price) }}"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Short Description</label>
                            <textarea name="short_desc" class="form-control" rows="3" placeholder="Write short description">{{ old('short_desc', $service->short_desc) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Description</label>
                            <textarea name="description" class="form-control" rows="5" placeholder="Write description">{{ old('description', $service->description) }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Status</label>
                            <select name="status" class="form-select" data-control="select2" data-placeholder="Choose any Option">
                                <option></option>
                                <option value="1" {{ old('status', $service->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $service->status) == '0' ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/js/services/edit.js?v='.rand()) }}"></script>
@endsection
