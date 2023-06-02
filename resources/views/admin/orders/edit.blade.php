@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/list-product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detorder.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper">
                <div>
                    <h1>Update Orders</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('admin.orders.index') }}">Orders</a></span>
                        <span><img src="/assets/svg/arrow-down.svg" style="transform: rotate(-90deg)"
                                alt="" /></span>Update Orders
                    </p>
                </div>
            </div>
            <div>
                <div>
                    <div class="order-detail-product-wrap">Order Status :
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
                        <div style="margin: 10px 10px 10px 10px"></div>
                        @foreach ($order->orderItems()->with('product')->get() as $orderItem)
                            <div class="order-detail-product-gap"></div>
                            <div class="order-detail-product">
                                <div>
                                    <a class="order-detail-product-item">
                                        <div class="product-item-detail-wrap">
                                            <div class="product-item-detail">
                                                <div class="product-item-detail-img">
                                                    <div class="item-detail-img-content"
                                                        style="background-image: url({{ asset('storage/' . $orderItem->product->images[0]) }})">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-detail-text">
                                                <div>
                                                    <div class="item-detail-title-wrap">
                                                        <span
                                                            class="item-detail-title">{{ $orderItem->product->name }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="item-detail-category">
                                                        {{ $orderItem->product->agency->name }}
                                                    </div>
                                                    <div class="item-detail-qty">
                                                        x{{ $orderItem->quantity }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-detail-price-wrap">
                                            <div>
                                                <span
                                                    class="item-detail-price">Rp.{{ number_format($orderItem->items_price, 0, '.', '.') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="item-detail-total-wrap">
                        <div class="item-detail-row item-detail-total-wrap">
                            <div class="item-detail-col item-detail-total">
                                <span>Order Total</span>
                            </div>
                            <div class="item-detail-amount">
                                <div class="item-detail-amount-total">
                                    Rp.{{ number_format($order->total_amount, 0, '.', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-gap"></div>
                    <div>
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            <div class="order-detail-info">

                                <div class="addprod-title-col">
                                    <label for="order_status_id" class="form-label">Order Status :</label>
                                    <select name="order_status_id" id="order_status_id" class="form-select">
                                        @foreach ($order_statuses as $order_status)
                                            <option value="{{ $order_status->id }}"
                                                {{ $order->order_status_id == $order_status->id ? 'selected' : '' }}>
                                                {{ $order_status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="order-detail-info-pred"></div>

                                <button class="order-received" type="submit">
                                    <a style="color: white">Update</a>
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
