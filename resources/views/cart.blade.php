@php
    $overallSubtotal = 0;
    $totalQuantity = 0;
    $canCheckout = true;
@endphp

@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    <div class="wrapper cart-top">
        <center>
            <h1>Cart</h1>
        </center>
        @foreach ($cartItems as $cartItem)
            <div class="product-cart">
                <div class="cart-wrap">
                    <div class="cart-content">
                        <div class="cart-check">
                            <label class="checkbox checkbox-field">
                                <input type="checkbox" name="checkbox" data-name="Checkbox"
                                    class="checkbox-input checkbox-2" />
                            </label>
                        </div>
                        <div class="cart-detail">
                            <div class="detail-layout">
                                <a href="/detprod.html">
                                    <div class="cart-detail-img"
                                        style="background-image: url({{ 'storage/' . $cartItem->product->images[0] }})">
                                    </div>
                                </a>
                                <div class="cart-detail-title">
                                    <a class="cart-detail-text" title="RED VELVET - 8TH ANNIVERSARY - LUCKY CARD SET"
                                        href="/detprod.html">{{ $cartItem->product->name }}</a>

                                    <span class="varian">{{ $cartItem->product->agency->name }}</span>


                                </div>
                            </div>
                        </div>
                        <div class="cart-idv-price">
                            @if ($cartItem->product->stock > 0)
                                @if ($cartItem->product->discounted_price)
                                    <div>
                                        <span class="idv-price">Rp.
                                            {{ number_format($cartItem->product->discounted_price, 0, '.', '.') }}</span>
                                    </div>
                                    <div>
                                        <span class="idv-price idv-price-before">Rp.
                                            {{ number_format($cartItem->product->price, 0, '.', '.') }}</span>
                                    </div>
                                @else
                                    <div>
                                        <span class="idv-price ">Rp.
                                            {{ number_format($cartItem->product->price, 0, '.', '.') }}</span>
                                    </div>
                                @endif
                            @else
                                <li class="sold-out">SOLD OUT</li>
                            @endif
                            <div><span class="cart-discount">Stock : {{ $cartItem->product->stock }}</span></div>


                        </div>
                        <div class="cart-qty">
                            <div class="qty-component">
                                <form action="{{ route('cart.decrease', ['cartItemId' => $cartItem->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="qty-btn">
                                        <img src="assets/svg/minus.svg" type="submit" alt="Minus" /></button>
                                </form>
                                <form action="{{ route('cart.update', ['cartItemId' => $cartItem->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input id="quantityInput" name="quantity" class="qty-btn qty-val" type="number"
                                        value="{{ $cartItem->quantity }}" onkeydown="submitOnEnter(event)" />
                                </form>
                                <form action="{{ route('cart.increase', ['cartItemId' => $cartItem->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="qty-btn">
                                        <img src="assets/svg/plus.svg" alt="Plus" />
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if ($cartItem->product->discounted_price)
                            @php
                                $cartItemSubtotals[$cartItem->id] = $cartItem->product->discounted_price * $cartItem->quantity;
                                $overallSubtotal += $cartItemSubtotals[$cartItem->id];
                            @endphp
                        @else
                            @php
                                $cartItemSubtotals[$cartItem->id] = $cartItem->product->price * $cartItem->quantity;
                                $overallSubtotal += $cartItemSubtotals[$cartItem->id];
                            @endphp
                        @endif
                        @if ($cartItem->product->stock > 0)
                            <div class="cart-total-price">
                                <span>Rp.
                                    {{ number_format($cartItemSubtotals[$cartItem->id], 0, '.', '.') }}</span>
                            </div>
                        @else
                            <span class="sold-out">SOLD OUT</span>
                        @endif

                        <div class="cart-remove-item">
                            <a href="{{ route('cart.remove', $cartItem->id) }}"class="remove-btn">Remove</a>
                        </div>

                        @if ($cartItem->product->stock < $cartItem->quantity)
                            @php
                                $canCheckout = false;
                            @endphp
                        @endif


                    </div>
                </div>
            </div>
            @php
                $totalQuantity += $cartItem->quantity;
            @endphp
        @endforeach
    </div>
    <div class="wrapper cart-bottom">
        <div class="voucher-col">

        </div>



        <div class="cart-checkout">

        </div>
        <div class="co-info">
            <div class="co-qty">Total ({{ $totalQuantity }} item(s)):</div>
            <div class="co-price">Rp. {{ number_format($overallSubtotal, 0, '.', '.') }}</div>
        </div>

        @if (count($cartItems) > 0)
            @if (count(auth()->user()->addresses) > 0)
                @if ($canCheckout)
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="cart-button-solid">
                            <a class="co-btn">Checkout</a>
                        </button>
                    </form>
                @else
                    <button class="cart-button-solid" disabled>
                        <a class="co-btn" disabled>Checkout</a>
                    </button>
                    <span class="sold-out">
                        Some of your items are sold out
                    </span>
                @endif
            @else
                <button class="cart-button-solid" disabled>
                    <a class="co-btn" disabled>Checkout</a>
                </button>
                <span class="sold-out">Please add an address first</span>
            @endif
        @else
            <button class="cart-button-solid" disabled>
                <a class="co-btn" disabled>Checkout</a>
            </button>
            <span class="sold-out">Your cart is empty</span>
        @endif
    </div>
    <script>
        function submitOnEnter(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                event.target.form.submit();
            }
        }
    </script>
@endsection
