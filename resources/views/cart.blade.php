@php
    $overallSubtotal = 0;
    $totalQuantity = 0;
    $canCheckout = true;
@endphp

@extends('layouts.main')

@section('title', 'Cart | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <div>
            <div class="wrapper cart-top">
                @if ($cartItems->count() > 0)
                    <center>
                        <h1>Cart</h1>
                    </center>
                @endif
                @forelse ($cartItems as $cartItem)
                    <div class="product-cart">
                        <div class="cart-wrap">
                            <div class="cart-content">
                                <div class="cart-check">
                                    <label class="checkbox checkbox-field">
                                        <input type="checkbox" name="checked_items[]" value="{{ $cartItem->id }}"
                                            class="checkbox-input checkbox-2" />
                                    </label>
                                </div>
                                <div class="cart-detail">
                                    <div class="detail-layout">
                                        <a href="{{ route('product-details.show', $cartItem->product->id) }}">
                                            <div class="cart-detail-img"
                                                style="background-image: url({{ 'storage/' . $cartItem->product->images[0] }})">
                                            </div>
                                        </a>
                                        <div class="cart-detail-title">
                                            <a class="cart-detail-text"
                                                title="RED VELVET - 8TH ANNIVERSARY - LUCKY CARD SET"
                                                href="{{ route('product-details.show', $cartItem->product->id) }}">{{ $cartItem->product->name }}</a>

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
                                        <form action="{{ route('cart.decrease', ['cartItemId' => $cartItem->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button class="qty-btn">
                                                <img src="assets/svg/minus.svg" type="submit" alt="Minus" /></button>
                                        </form>
                                        <form action="{{ route('cart.update', ['cartItemId' => $cartItem->id]) }}"
                                            method="POST">
                                            @csrf
                                            <input id="quantityInput" name="quantity" class="qty-btn qty-val" type="number"
                                                value="{{ $cartItem->quantity }}" onkeydown="submitOnEnter(event)" />
                                        </form>
                                        <form action="{{ route('cart.increase', ['cartItemId' => $cartItem->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button class="qty-btn">
                                                <img src="assets/svg/plus.svg" alt="Plus" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if ($cartItem->product->discounted_price)
                                    @php
                                        $cartItemSubtotals[$cartItem->id] = $cartItem->product->discounted_price * $cartItem->quantity;
                                    @endphp
                                @else
                                    @php
                                        $cartItemSubtotals[$cartItem->id] = $cartItem->product->price * $cartItem->quantity;
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
                                    <form action="{{ route('cart.remove', $cartItem->id) }}"method="POST">
                                        @csrf
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </div>

                                @if ($cartItem->product->stock < $cartItem->quantity)
                                    @php
                                        $canCheckout = false;
                                    @endphp
                                @endif


                            </div>
                        </div>
                    </div>
                @empty
                    <center>
                        <div style="margin: 12vh 0px 20vh 0px">
                            <img src="
                    {{ asset('assets/icon/nocart.svg') }}
                    "
                                style="width: 13rem;">
                            <h2 style="font-weight: bold;font-size: 1.5rem;">
                                Oopsie! You forgot to put it in the cart.
                            </h2>
                            <p>
                                Please add some product and <span style="color: #eab8c0">'Feel the Rhythm'</span> of
                                shopping
                                delight!
                            </p>
                        </div>
                    </center>
                @endforelse
            </div>
            <div class="wrapper cart-bottom">
                <div class="voucher-col">
                </div>
                <div class="cart-checkout">
                </div>
                <div class="co-info">
                    <div id="totalQuantity" class="co-qty">Total ({{ $totalQuantity }} item(s)):</div>
                    <div id="overallSubtotal" class="co-price">Rp. {{ number_format($overallSubtotal, 0, '.', '.') }}</div>
                </div>

                @if (count($cartItems) > 0)
                    @if (count(auth()->user()->addresses) > 0)
                        @if ($canCheckout)
                            <button type="submit" class="cart-button-solid">
                                <a class="co-btn">Checkout</a>
                            </button>
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
                @if (session('error'))
                    <span class="sold-out">{{ session('error') }}</span>
            </div>
            @endif
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('input.checkbox-input').change(function() {
            var totalQuantity = 0;
            var overallSubtotal = 0;

            $('input.checkbox-input:checked').each(function() {
                var $cartItem = $(this).closest('.product-cart');
                var quantity = parseInt($cartItem.find('.qty-val').val());
                var subtotal = parseInt($cartItem.find('.cart-total-price span').text().replace(/[^0-9]/g,
                    ''));

                totalQuantity += quantity;
                overallSubtotal += subtotal;
            });

            $('#totalQuantity').text('Total (' + totalQuantity + ' item(s)):');
            $('#overallSubtotal').text('Rp. ' + formatNumber(overallSubtotal));
        });

        function formatNumber(number) {
            return number.toLocaleString('id-ID');
        }

        function submitOnEnter(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                event.target.form.submit();
            }
        }
    </script>
@endsection
