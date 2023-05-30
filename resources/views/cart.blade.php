@php
    $overallSubtotal = 0;
    $totalQuantity = 0;
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

                                    <span class="varian">SM Ent.</span>


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
            <div class="voucher-text">Enter Promo Code :</div>
            <input class="voucher-inp" type="text" />
        </div>

        <div class="voucher-dsc">
            <div class="voucher-dsc-text">Discount :</div>
        </div>
        <div class="voucher-dsc-total">-Rp0</div>
        <div class="cart-checkout">
            <div class="select-all-check">
                <label class="checkbox checkbox-field">
                    <input type="checkbox" name="checkbox" data-name="Checkbox" class="checkbox-input checkbox-2" />
                </label>
            </div>
            <button class="remove-btn">Select All</button><button class="remove-btn remove-selected">Remove</button>
        </div>
        <div class="co-info">
            <div class="co-qty">Total ({{ $totalQuantity }} item(s)):</div>
            <div class="co-price">Rp. {{ number_format($overallSubtotal, 0, '.', '.') }}</div>
        </div>
        <button class="cart-button-solid">
            <a href="checkout.html" class="co-btn">Checkout</a>
        </button>
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
