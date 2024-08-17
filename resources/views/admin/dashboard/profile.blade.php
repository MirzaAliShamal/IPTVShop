@extends('layouts.admin')

@section('title', 'Profile Setting')
@section('page-title', 'Profile Setting')

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="" class="text-muted text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Profile Settings</li>
    </ul>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card mb-5 mb-xl-10">
            <form action="{{ route('admin.profile.basic') }}" method="POST">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">General Details</h3>
                    </div>
                </div>
                <div class="card-body p-9">
                    @csrf
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                    <input type="text" name="name" class="@error('name') is-invalid @enderror form-control form-control-lg form-control-solid" placeholder="Name" value="{{ auth()->user()->name }}" autocomplete="off">
                                    @error('name')
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                    <input type="email" name="email" class="@error('email') is-invalid @enderror form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{ auth()->user()->email }}" autocomplete="off">
                                    @error('email')
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

        <div class="card mb-5 mb-xl-10">
            <form action="{{ route('admin.profile.password') }}" method="POST">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Security Details</h3>
                    </div>
                </div>
                <div class="card-body p-9">
                    @csrf
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">New Password</label>
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                    <input type="password" name="password" class="@error('password') is-invalid @enderror form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                    @error('password')
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">Confirm Password</label>
                        <div class="col-lg-8">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                    <input type="password" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                    @error('password_confirmation')
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
