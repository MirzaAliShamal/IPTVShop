@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Active Subscriptions</div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="rounded-start">Subscription Name</th>
                                    <th>Date of Subscription</th>
                                    <th>Date of Expired</th>
                                    <th class="rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                </tr>
                                <tr>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                    <td>Hello</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
