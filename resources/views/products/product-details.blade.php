@php
    $totalQuantity = 1;
@endphp


@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detprod.css') }}">
@endsection

@section('content')
    <div class="wrapper split-container">
        <div class="left-side">
            <div class="big-img">
                <img src="{{ asset('storage/' . $product->images[1]) }}" alt="image" height="520" width="520" />
            </div>
            <div class="images">
                @foreach (array_slice($product->images, 1) as $image)
                    <div class="
                    {{ $loop->first ? 'first-small' : '' }}
                    small-img">
                        <img src="{{ asset('storage/' . $image) }}" alt="image" height="103" width="103"
                            onclick="showImg(this.src)" />
                    </div>
                @endforeach
            </div>
            <div class="caption">
                <div class="detail-product">
                    <h3 class="juduldetail">Product Details</h3>
                    <hr />
                    <p class="ket">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>
        <div class="right-side">
            <div class="checkout">
                <div class="checkout-table">
                    <div class="checkout-top">
                        <h2>
                            <em>
                                {{ $product->agency->name }}
                            </em>
                            {{ $product->name }}
                        </h2>
                        <div class="price-now">
                            @if ($product->stock > 0)
                                @if ($product->discounted_price)
                                    <span>Rp. {{ number_format($product->discounted_price, 0, '.', '.') }}</span>
                                    <span class="price-before">Rp.
                                        {{ number_format($product->price, 0, '.', '.') }}</span>
                                    <span
                                        class="discount">{{ intval((($product->price - $product->discounted_price) / $product->price) * 100) }}%
                                        OFF</span>
                                @else
                                    <span>Rp. {{ number_format($product->price, 0, '.', '.') }}</span>
                                @endif
                            @else
                                <span class="discount">SOLD OUT</span>
                            @endif



                        </div>
                    </div>
                    <table border="0">
                        <tbody>
                            <tr>

                                <td>
                                    Stock : {{ $product->stock }}
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="imp-info">
                                    <span style="font-size: 14px; color: #232744">
                                        @if ($product->discounted_price)
                                            *Hurry up! Offer ends soon.
                                        @else
                                            *Hurry up! Limited stock.
                                        @endif
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="totalPrice">
                        <span>TOTAL</span>
                        <div>
                            <button class="minusBtn">
                                <img src="{{ asset('assets/svg/minus.svg') }}" alt="Minus" />
                            </button>
                            <span class="qty">{{ $totalQuantity }}</span>
                            <button class="plusBtn">
                                <img src="{{ asset('assets/svg/plus.svg') }}" alt="Plus" />
                            </button>
                        </div>
                        <span class="total"><strong><em><span id="totalPrice">
                                        @if ($product->discounted_price)
                                            Rp.
                                            {{ number_format($product->discounted_price * $totalQuantity, 0, '.', '.') }}
                                        @else
                                            Rp. {{ number_format($product->price * $totalQuantity, 0, '.', '.') }}
                                        @endif
                                    </span></em></strong>
                            (<span class="total-qty">{{ $totalQuantity }}</span> item(s))</span>
                    </div>
                    <div class="checkout-bottom">
                        <div class="base-button" style="position: relative">
                            @if ($product->stock > 0)
                                <form action="{{ route('checkout.buy_now', ['productId' => $product->id]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" id="quantityInput" value="{{ $totalQuantity }}">
                                    <button type="submit" class="first" style="display: block">
                                        <span>Buy Now</span>
                                    </button>
                                </form>
                            @else
                                <button class="first" style="display: block" disabled>
                                    <span>SOLD OUT</span>
                                </button>
                            @endif
                            <form action="{{ route('detail.cart.add', ['productId' => $product->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" id="quantityInput" value="{{ $totalQuantity }}">
                                <button class="fleft" style="display: block">Add to Cart</button>
                            </form>


                            @auth
                                @if (auth()->user()->wishlist()->exists())
                                    @if (auth()->user()->wishlist()->first()->wishlistItems()->where('product_id', $product->id)->exists())
                                        <form
                                            action="{{ route('wishlist.remove',auth()->user()->wishlist()->first()->wishlistItems()->where('product_id', $product->id)->first()) }}"
                                            method="POST">
                                            @csrf
                                            <button class="fright wl">Remove From Wish List</button>
                                        @else
                                            <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="fright">Add to Wish List</button>
                                            </form>
                                    @endif
                                @else
                                    <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button class="fright">Add to Wish List</button>
                                    </form>
                                @endif
                            @else
                                <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}" method="POST">
                                    @csrf
                                    <button class="fright">Add to Wish List</button>
                                </form>
                            @endauth





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const minusBtn = document.querySelector('.minusBtn');
        const plusBtn = document.querySelector('.plusBtn');
        const qtyElement = document.querySelector('.qty');
        const totalQtyElement = document.querySelector('.total-qty');
        const totalPriceElement = document.querySelector('#totalPrice');
        const pricePerItem = {!! $product->discounted_price ? $product->discounted_price : $product->price !!};
        const quantityInput = document.getElementById('quantityInput');
        const stockLimit = {{ $product->stock }};
        let quantity = {{ $totalQuantity }};

        const updateQuantity = () => {
            qtyElement.textContent = quantity;
            totalQtyElement.textContent = quantity;
            const totalPrice = pricePerItem * quantity;
            totalPriceElement.textContent = 'Rp. ' + totalPrice.toLocaleString('id-ID');
            quantityInput.value = quantity;

            if (quantity >= stockLimit) {
                plusBtn.disabled = true;
            } else {
                plusBtn.disabled = false;
            }
        };

        minusBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                updateQuantity();
            }
        });


        plusBtn.addEventListener('click', () => {
            if (quantity < stockLimit) {
                quantity++;
                updateQuantity();
            }
        });
    });
</script>
