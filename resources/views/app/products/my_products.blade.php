@extends('layouts.app')

@section('title', 'My Products')
@section('page-title', 'My Products')

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Products</div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th class="rounded-start">Product Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="align-top">{{ $order->product->title }} </td>
                                        <td>{{ $order->product->price.'€' }}</td>
                                        <td class="align-top">
                                            @if ($order->status == "pending")
                                                <span class="badge text-bg-primary">Pending</span>
                                            @elseif ($order->status == "shipped")
                                                <span class="badge text-bg-success">Shipped</span>
                                            @elseif ($order->status == "delivered")
                                                <span class="badge text-bg-success">Delivered</span>
                                            @elseif ($order->status == "canceled")
                                                <span class="badge text-bg-danger">Canceled</span>
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
