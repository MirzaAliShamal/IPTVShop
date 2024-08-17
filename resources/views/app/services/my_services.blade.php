@extends('layouts.app')

@section('title', 'My Services')
@section('page-title', 'My Services')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Services</div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="rounded-start">Service Name</th>
                                    <th>Date of Subscription</th>
                                    <th>Date of Expired</th>
                                    <th>Status</th>
                                    <th class="rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcriptions as $subscription)
                                    <tr>
                                        <td class="align-top">
                                            <div class="d-flex flex-column gap-3">
                                                <strong>{{ $subscription->title }}</strong>
                                                <div>{!! $subscription->details !!}</div>
                                            </div>
                                        </td>
                                        <td class="align-top">
                                            @if (is_null($subscription->started_at))
                                                N/A
                                            @else
                                                {{ $subscription->started_at }}
                                            @endif
                                        </td>
                                        <td class="align-top">
                                            @if (is_null($subscription->expired_at))
                                                N/A
                                            @else
                                                {{ $subscription->expired_at }}
                                            @endif
                                        </td>
                                        <td class="align-top">
                                            @if ($subscription->status == "pending")
                                                <span class="badge text-bg-primary">Pending</span>
                                            @elseif ($subscription->status == "started")
                                                <span class="badge text-bg-success">Started</span>
                                            @elseif ($subscription->status == "expired")
                                                <span class="badge text-bg-danger">Expired</span>
                                            @elseif ($subscription->status == "suspended")
                                                <span class="badge text-bg-warning">Suspended</span>
                                            @endif
                                        </td>
                                        <td class="align-top">
                                            @if ($subscription->status == "expired")
                                                <a href="" class="btn btn-primary">Renew</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
