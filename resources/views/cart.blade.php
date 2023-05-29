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
        @foreach ($cartItems as $item)
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
                                        style="background-image: url({{ 'storage/' . $item->product->images[0] }})">
                                    </div>
                                </a>
                                <div class="cart-detail-title">
                                    <a class="cart-detail-text" title="RED VELVET - 8TH ANNIVERSARY - LUCKY CARD SET"
                                        href="/detprod.html">{{ $item->product->name }}</a>

                                    <span class="varian">SM Ent.</span>


                                </div>
                            </div>
                        </div>
                        <div class="cart-idv-price">
                            @if ($item->product->stock > 0)
                                @if ($item->product->discounted_price)
                                    <div>
                                        <span class="idv-price">Rp.
                                            {{ number_format($item->product->discounted_price, 0, '.', '.') }}</span>
                                    </div>
                                    <div>
                                        <span class="idv-price idv-price-before">Rp.
                                            {{ number_format($item->product->price, 0, '.', '.') }}</span>
                                    </div>
                                @else
                                    <div>
                                        <span class="idv-price ">Rp.
                                            {{ number_format($item->product->price, 0, '.', '.') }}</span>
                                    </div>
                                @endif
                            @else
                                <li class="sold-out">SOLD OUT</li>
                            @endif
                            <div><span class="cart-discount">Stock : {{ $item->product->stock }}</span></div>


                        </div>
                        <div class="cart-qty">
                            <div class="qty-component">
                                <form action="{{ route('cart.decrease-quantity', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="qty-btn">
                                        <img src="assets/svg/minus.svg" type="submit" alt="Minus" /></button>
                                </form>
                                <input id="quantityInput" name="quantity" class="qty-btn qty-val" type="number"
                                    value="{{ $item->quantity }}"
                                    oninput="updateQuantity({{ $item->id }}, this.value)" />
                                <form action="{{ route('cart.increase-quantity', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="qty-btn">
                                        <img src="assets/svg/plus.svg" alt="Plus" />
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if ($item->product->discounted_price)
                            @php
                                $itemSubtotals[$item->id] = $item->product->discounted_price * $item->quantity;
                                $overallSubtotal += $itemSubtotals[$item->id];
                            @endphp
                        @else
                            @php
                                $itemSubtotals[$item->id] = $item->product->price * $item->quantity;
                                $overallSubtotal += $itemSubtotals[$item->id];
                            @endphp
                        @endif
                        @if ($item->product->stock > 0)
                            <div class="cart-total-price">
                                <span>Rp.
                                    {{ number_format($itemSubtotals[$item->id], 0, '.', '.') }}</span>
                            </div>
                        @else
                            <span class="sold-out">SOLD OUT</span>
                        @endif

                        <div class="cart-remove-item">
                            <a href="{{ route('cart.remove', $item->id) }}"class="remove-btn">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $totalQuantity += $item->quantity;
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
        function updateQuantity(cartItemId, newQuantity) {
            // Send an AJAX request to update the quantity
            $.ajax({
                url: '/cart/' + cartItemId + '/update-quantity',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: newQuantity
                },
                success: function(response) {
                    // Handle the success response
                    console.log(response);
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection
