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
                        <span><a href="index.html">Home</a></span>
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
                                    <div class="dataTables_filter">
                                        <label>Search &nbsp;<input type="search" class="form-search"
                                                placeholder="" /></label>
                                    </div>
                                </div>
                                <table class="table dataTable no-footer" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Product Name</th>
                                            <th class="row-title">Qty</th>
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
                                                    <a class="" href="">
                                                        {{ $order->user->name }}
                                                    </a>
                                                </td>
                                                <td class="row-title">
                                                    {{ $order->orderItems->sum('quantity') }}
                                                </td>
                                                <td class="row-title">
                                                    {{ $order->created_at->format('d-m-Y') }}
                                                </td>
                                                <td class="row-title">
                                                    {{ $order->total_amount }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">
                                                        {{ $order->orderStatus->name }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="bottom-information">
                                    <div class="dataTables_info">
                                        Showing 1 to 20 of 88 entries
                                    </div>
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        <div class="pagination">
                                            <a href="#">&laquo;</a>
                                            <a href="#" class="active">1</a>
                                            <a href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
                                            <a href="#">6</a>
                                            <a href="#">&raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
