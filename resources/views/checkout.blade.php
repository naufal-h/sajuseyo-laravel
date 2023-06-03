@php
    $overallSubtotal = 0;
@endphp

@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')
    <div class="wrapper checkout-wrap">
        <div class="checkout-top">
            <div class="garis-garis"></div>
            <div class="checkout-top-wrap">
                <div class="checkout-top-addr">
                    <div class="checkout-top-addr-wrap">
                        <div class="checkout-top-addr-icon">
                            <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.4458 26.6183C9.23393 23.9607 5.16634 19.5596 5.16634 14.2083C5.16634 8.50139 9.7927 3.875 15.4997 3.875C21.2066 3.875 25.833 8.50139 25.833 14.2083C25.833 19.5596 21.7654 23.9607 16.5535 26.6183C15.8913 26.9559 15.108 26.9559 14.4458 26.6183Z"
                                    stroke="#EAB8C0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M11.625 14.208C11.625 16.3482 13.3598 18.083 15.5 18.083C17.6402 18.083 19.375 16.3482 19.375 14.208C19.375 12.0679 17.6402 10.333 15.5 10.333C13.3598 10.333 11.625 12.0679 11.625 14.208Z"
                                    stroke="#EAB8C0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>Address</div>
                    </div>
                </div>
                <div class="checkout-top-info">
                    <div>
                        <div class="checkout-top-info-wrap">
                            <div class="checkout-top-info-name">
                                {{ $address->name }} <br />
                                {{ $address->phone }}
                            </div>
                            <div class="checkout-top-info-addr">
                                {{ $address->address }} ,
                                {{ $address->city }}, {{ $address->province }},
                                {{ $address->postal_code }}
                            </div>
                            <div class="checkout-top-info-ctgr">Default</div>
                        </div>
                    </div>
                    <a href="{{ route('addresses.index') }}" class="checkout-top-info-change">Change</a>
                </div>
            </div>
        </div>
        <div class="checkout-main">
            <div class="checkout-main-top">
                <div class="checkout-main-top-grid">
                    <div class="checkout-main-top-col">
                        <div class="checkout-main-top-h">Products Ordered</div>
                    </div>
                </div>
            </div>
            <div>
                <div class="checkout-main-content">
                    <div>
                        <div class="checkout-main-product">
                            <div class="checkout-main-product-gap"></div>
                            @foreach ($cartItems as $cartItem)
                                <div class="checkout-product-details">
                                    <div class="checkout-product-wrap checkout-product">
                                        <div class="product-info-wrap product-info">
                                            <div class="cart-detail-img"
                                                style="background-image: url({{ 'storage/' . $cartItem->product->images[0] }})">
                                            </div>
                                            <span class="product-info-title"><span
                                                    class="product-info-text">{{ $cartItem->product->name }}</span>
                                                <div class="product-info-category">
                                                    <span
                                                        class="product-info-category-wrap product-info-category-text">{{ $cartItem->product->agency->name }}</span>
                                                </div>
                                            </span>
                                        </div>

                                        <div class="product-info-wrap">
                                            @if ($cartItem->product->discounted_price)
                                                @php
                                                    $overallSubtotal += $cartItem->product->discounted_price * $cartItem->quantity;
                                                @endphp
                                                <span class="product-info-text">
                                                    Rp.
                                                    {{ number_format($cartItem->product->discounted_price, 0, '.', '.') }}
                                                </span>
                                            @else
                                                @php
                                                    $overallSubtotal += $cartItem->product->price * $cartItem->quantity;
                                                @endphp
                                                <span class="product-info-text product-info-text-discounted">
                                                    Rp.
                                                    {{ number_format($cartItem->product->price, 0, '.', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product-info-wrap">
                                            {{ $cartItem->quantity }}
                                        </div>
                                        <div class="product-info-wrap product-info-total">
                                            @if ($cartItem->product->discounted_price)
                                                <span class="product-info-text">
                                                    Rp.
                                                    {{ number_format($cartItem->product->discounted_price * $cartItem->quantity, 0, '.', '.') }}
                                                </span>
                                            @else
                                                <span class="product-info-text product-info-text-discounted">Rp.
                                                    {{ number_format($cartItem->product->price * $cartItem->quantity, 0, '.', '.') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="checkout-main-bottom">
                        <div class="checkout-main-bottom-col checkout-main-bottom-grid">
                            <div class="checkout-main-ship-opt">Shipping Option:</div>
                            <div class="checkout-main-ship-type">
                                <div>
                                    {{ $courier == 'jne' ? 'JNE' : ($courier == 'pos' ? 'Pos Indonesia' : 'TIKI') }}
                                </div>
                            </div>

                            <div class="checkout-main-ship-est">
                                Est Arrival: 5-14 days
                            </div>
                            <div class="usnm-drop">
                                <div class="checkout-main-ship-change">Change</div>
                                <div class="usnm-opt">
                                    <form id="changeCourier" action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="courier" value="jne">
                                        <a href="#" id="submitButton">JNE</a>
                                    </form>
                                    <form id="changeCourier2" action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="courier" value="pos">
                                        <a href="#" id="submitButton2">Pos Indonesia</a>
                                    </form>
                                    <form id="changeCourier3" action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="courier" value="tiki">
                                        <a href="#" id="submitButton3">TIKI</a>
                                    </form>
                                </div>
                            </div>
                            <div class="checkout-main-ship-cost">
                                Rp. {{ number_format($shippingCost, 0, '.', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="checkout-main-total-wrap">
                        <div class="checkout-main-total">
                            <div class="checkout-main-total-qty">Total (
                                {{ app('App\Http\Controllers\CartController')->getCartTotalQuantity() }}
                                item(s)):</div>
                            <div class="checkout-main-total-price">
                                Rp. {{ number_format($overallSubtotal, 0, '.', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('checkout.place_order') }}" method="POST">
            @csrf
            <input type="hidden" name="courier" value="{{ $courier }}">
            <input type="hidden" name="shippingCost" value="{{ $shippingCost }}">

            <div class="checkout-bottom">
                <div class="checkout-bottom-gap"></div>
                <div class="checkout-bottom-col">
                    <div class="checkout-bottom-item checkout-bottom-item-left checkout-bottom-item-1st">
                        Subtotal:
                    </div>
                    <div class="checkout-bottom-item checkout-bottom-item-right checkout-bottom-item-1st">
                        Rp. {{ number_format($overallSubtotal, 0, '.', '.') }}
                    </div>
                    <div class="checkout-bottom-item checkout-bottom-item-left checkout-bottom-item-2nd">
                        Shipping Fee:
                    </div>
                    <div class="checkout-bottom-item checkout-bottom-item-right checkout-bottom-item-2nd">
                        Rp. {{ number_format($shippingCost, 0, '.', '.') }}
                    </div>

                    <div class="checkout-bottom-item checkout-bottom-item-left cart-total">
                        Total:
                    </div>
                    <div class="checkout-bottom-item kC0GSn checkout-bottom-item-right cart-total">
                        Rp. {{ number_format($overallSubtotal + $shippingCost, 0, '.', '.') }}
                    </div>
                    <div class="checkout-bottom-button">
                        <button type="submit" class="co-button-solid">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <script>
        const submitButton = document.getElementById('submitButton');
        const submitButton2 = document.getElementById('submitButton2');
        const submitButton3 = document.getElementById('submitButton3');
        const form = document.getElementById('changeCourier');
        const form2 = document.getElementById('changeCourier2');
        const form3 = document.getElementById('changeCourier3');


        submitButton.addEventListener('click', function(event) {
            event.preventDefault();
            form.submit();
            // console.log('clicked');
        });

        submitButton2.addEventListener('click', function(event) {
            event.preventDefault();
            form2.submit();
            // console.log('clicked');
        });

        submitButton3.addEventListener('click', function(event) {
            event.preventDefault();
            form3.submit();
            // console.log('clicked');
        });
    </script>
@endsection
