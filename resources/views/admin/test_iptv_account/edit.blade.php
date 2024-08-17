@extends('layouts.admin')

@section('title', 'Test IPTV Accounts')
@section('page-title', 'Test IPTV Accounts')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('admin.test.iptv.index') }}" class="text-muted text-hover-primary">Test IPTV Accounts</a>
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
                <h3>Edit Test IPTV Account</h3>
            </div>
        </div>
        <div class="card-body py-10">
            <form action="{{ route('admin.test.iptv.update', $testIptvAccount->id) }}" method="POST" class="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-5">
                            <label class="required form-label">Account Details</label>
                            <textarea name="details" id="details" rows="5">{{ $testIptvAccount->details }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-primary me-2">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.test.iptv.index') }}" class="btn btn-secondary">
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
    <script src="{{ asset('admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/test-iptv-account/edit.js?v='.rand()) }}"></script>
@endsection
