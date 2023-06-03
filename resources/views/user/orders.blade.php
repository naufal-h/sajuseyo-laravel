@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detorder.css') }}">
@endsection

@section('content')
    <div class="wrapper user-wrap">
        <div class="user-container">
            @include('layouts.userprofile')
            <div class="width1140">
                @include('layouts.userside')
                <div class="detail-order-main">
                    <div class="detail-order-main-wrap">
                        @include('layouts.orders-filter')
                        <div></div>
                        @foreach ($orders as $order)
                            <div class="detail-order-main-item">
                                <div class="detail-order-main-content">
                                    <div class="detail-order-head">
                                        <div>
                                            <span>Order ID : {{ $order->id }}</span><span class="divider">|</span>
                                            @if ($order->order_status_id == 1)
                                                Confirmation received for your order
                                            @elseif ($order->order_status_id == 2)
                                                Waiting for payment confirmation
                                            @elseif ($order->order_status_id == 3)
                                                Your order is being prepared
                                            @elseif ($order->order_status_id == 4)
                                                Your order is on the way
                                            @elseif ($order->order_status_id == 5)
                                                Order successfully completed
                                            @elseif ($order->order_status_id == 6)
                                                Your order has been canceled
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <div class="order-detail-product-wrap">
                                                @foreach ($order->orderItems()->with('product')->get() as $orderItem)
                                                    <div class="order-detail-product-gap"></div>
                                                    <div class="order-detail-product">
                                                        <div>
                                                            <a class="order-detail-product-item"
                                                                href="{{ route('orders.show', $order->id) }}">
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
                                                <div class="order-detail-info">
                                                    <div class="order-detail-info-pred"></div>
                                                    <a href="{{ route('orders.show', $order->id) }}">
                                                        <button class="order-received">
                                                            <p style="color: white">View Details</p>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="orders-filter"></div>
                            <div></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
