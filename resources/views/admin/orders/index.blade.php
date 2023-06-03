@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/list-product.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper">
                <div>
                    <h1>Orders</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                        <span><img src="/assets/svg/arrow-down.svg" style="transform: rotate(-90deg)"
                                alt="" /></span>Orders
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTables_wrapper">
                                <div class="top-information">

                                </div>
                                <table class="table dataTable no-footer" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Products Name</th>
                                            <th class="row-title">Date</th>
                                            <th class="row-title">Total</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    {{ $order->id }}
                                                </td>
                                                <td>
                                                    <a class="" href="{{ route('admin.orders.edit', $order->id) }}">
                                                        @foreach ($order->orderItems as $item)
                                                            {{ $item->product->name }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                </td>
                                                <td class="row-title">
                                                    {{ $order->created_at->format('d-m-Y H:i') }}
                                                </td>
                                                <td class="row-title">
                                                    Rp. {{ number_format($order->total_amount, 0, '.', '.') }}
                                                </td>
                                                <td>
                                                    @if ($order->orderStatus->id == 1)
                                                        <span class="badge badge-confirmed">
                                                        @elseif ($order->orderStatus->id == 2)
                                                            <span class="badge badge-paid">
                                                            @elseif ($order->orderStatus->id == 3)
                                                                <span class="badge badge-warning">
                                                                @elseif ($order->orderStatus->id == 4)
                                                                    <span class="badge badge-primary">
                                                                    @elseif ($order->orderStatus->id == 5)
                                                                        <span class="badge badge-success">
                                                                        @elseif ($order->orderStatus->id == 6)
                                                                            <span class="badge badge-danger">
                                                    @endif
                                                    {{ $order->orderStatus->name }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                {{ $orders->links('vendor.pagination.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
