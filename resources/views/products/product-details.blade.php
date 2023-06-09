@php
    $totalQuantity = 1;
@endphp


@extends('layouts.main')

@section('title', $product->name . ' | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detprod.css') }}">
@endsection

@section('content')
    <div class="wrapper split-container">
        <div class="left-side">
            <div class="big-img">
                <img id="big-image" src="{{ asset('storage/' . $product->images[0]) }}" alt="image" height="520"
                    width="520" style="object-fit: cover" />
            </div>
            <div class="images">
                @foreach (array_slice($product->images, 1, 4) as $index => $image)
                    <div class="{{ $loop->first ? 'first-small' : '' }} small-img">
                        <img id="small-image-{{ $index }}" src="{{ asset('storage/' . $image) }}" alt="image"
                            height="103" width="103" onclick="changeBigImage(this)" style="object-fit: cover" />
                    </div>
                @endforeach
            </div>
            @if (count($product->images) > 4)
                <div class="images">
                    @foreach (array_slice($product->images, 5) as $index => $image)
                        <div class="small-img">
                            <img id="small-image-{{ $index }}" src="{{ asset('storage/' . $image) }}" alt="image"
                                height="103" width="103" onclick="changeBigImage(this)" style="object-fit: cover" />
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="caption">
                <div class="detail-product">
                    <h3 class="juduldetail">Product Details</h3>
                    <hr />
                    <p class="ket">
                        {!! nl2br(e($product->description)) !!}
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
                                        @if ($product->stock > 0)
                                            @if ($product->discounted_price)
                                                *Hurry up! Offer ends soon.
                                            @else
                                                *Hurry up! Limited stock.
                                            @endif
                                        @else
                                            *Sorry, this product is sold out.
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
                            @auth
                                @if ($product->stock > 0)
                                    @if (auth()->user()->addresses()->exists())
                                        <form action="{{ route('checkout.buy_now', ['productId' => $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" id="quantityInput"
                                                value="{{ $totalQuantity }}">
                                            <button type="submit" class="first" style="display: block">
                                                <span>Buy Now</span>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('addresses.index') }}" class="first" style="display: block">
                                            <span>Buy Now</span>
                                        </a>
                                    @endif
                                @else
                                    <button class="first" style="display: block" disabled>
                                        <span>SOLD OUT</span>
                                    </button>
                                @endif
                            @else
                                <form action="{{ route('checkout.buy_now', ['productId' => $product->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" id="quantityInput" value="{{ $totalQuantity }}">
                                    <button type="submit" class="first" style="display: block">
                                        <span>Buy Now</span>
                                    </button>
                                </form>
                            @endauth
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

    <div class="main_section2">
        <center>
            <h1>You May Also Like</h1>
        </center>
        <div class="base-product">
            <ul class="product-list product-grid5">
                @foreach ($products as $product)
                    <li class="product-card">
                        <div class="thumbnail">
                            <div class="product-buttons">
                                @auth
                                    @if (auth()->user()->wishlist()->exists())
                                        @if (auth()->user()->wishlist()->first()->wishlistItems()->where('product_id', $product->id)->exists())
                                            <form
                                                action="{{ route('wishlist.remove',auth()->user()->wishlist()->first()->wishlistItems()->where('product_id', $product->id)->first()) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btninv">
                                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M9.00252 1.52123C6.98058 -0.0524605 4.05114 0.0891645 2.19283 1.94679C0.180516 3.9591 0.180516 7.22679 2.19283 9.2391L8.51233 15.5586C8.78114 15.8274 9.21633 15.8274 9.48514 15.5586L15.8046 9.2391C17.817 7.22679 17.817 3.9591 15.8046 1.94679C13.9553 0.0974144 11.0258 -0.0332104 9.00252 1.52123ZM8.99977 3.12173C9.30089 3.11623 9.45833 2.94435 9.48308 2.92304C11.1021 1.51366 13.3613 1.44835 14.8325 2.9196C16.3079 4.39498 16.3079 6.79092 14.8325 8.26698L8.99839 14.1004L3.16495 8.26698C1.68958 6.79092 1.68958 4.39498 3.16495 2.9196C4.64102 1.44354 7.03764 1.44423 8.5137 2.92029C8.64227 3.04885 8.81758 3.12173 8.99977 3.12173Z" />
                                                    </svg>
                                                </button>
                                            @else
                                                <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn">
                                                        <svg width="18" height="16" viewBox="0 0 18 16"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M9.00252 1.52123C6.98058 -0.0524605 4.05114 0.0891645 2.19283 1.94679C0.180516 3.9591 0.180516 7.22679 2.19283 9.2391L8.51233 15.5586C8.78114 15.8274 9.21633 15.8274 9.48514 15.5586L15.8046 9.2391C17.817 7.22679 17.817 3.9591 15.8046 1.94679C13.9553 0.0974144 11.0258 -0.0332104 9.00252 1.52123ZM8.99977 3.12173C9.30089 3.11623 9.45833 2.94435 9.48308 2.92304C11.1021 1.51366 13.3613 1.44835 14.8325 2.9196C16.3079 4.39498 16.3079 6.79092 14.8325 8.26698L8.99839 14.1004L3.16495 8.26698C1.68958 6.79092 1.68958 4.39498 3.16495 2.9196C4.64102 1.44354 7.03764 1.44423 8.5137 2.92029C8.64227 3.04885 8.81758 3.12173 8.99977 3.12173Z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                        @endif
                                    @else
                                        <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button class="btn">
                                                <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.00252 1.52123C6.98058 -0.0524605 4.05114 0.0891645 2.19283 1.94679C0.180516 3.9591 0.180516 7.22679 2.19283 9.2391L8.51233 15.5586C8.78114 15.8274 9.21633 15.8274 9.48514 15.5586L15.8046 9.2391C17.817 7.22679 17.817 3.9591 15.8046 1.94679C13.9553 0.0974144 11.0258 -0.0332104 9.00252 1.52123ZM8.99977 3.12173C9.30089 3.11623 9.45833 2.94435 9.48308 2.92304C11.1021 1.51366 13.3613 1.44835 14.8325 2.9196C16.3079 4.39498 16.3079 6.79092 14.8325 8.26698L8.99839 14.1004L3.16495 8.26698C1.68958 6.79092 1.68958 4.39498 3.16495 2.9196C4.64102 1.44354 7.03764 1.44423 8.5137 2.92029C8.64227 3.04885 8.81758 3.12173 8.99977 3.12173Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ route('wishlist.add', ['productId' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn">
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.00252 1.52123C6.98058 -0.0524605 4.05114 0.0891645 2.19283 1.94679C0.180516 3.9591 0.180516 7.22679 2.19283 9.2391L8.51233 15.5586C8.78114 15.8274 9.21633 15.8274 9.48514 15.5586L15.8046 9.2391C17.817 7.22679 17.817 3.9591 15.8046 1.94679C13.9553 0.0974144 11.0258 -0.0332104 9.00252 1.52123ZM8.99977 3.12173C9.30089 3.11623 9.45833 2.94435 9.48308 2.92304C11.1021 1.51366 13.3613 1.44835 14.8325 2.9196C16.3079 4.39498 16.3079 6.79092 14.8325 8.26698L8.99839 14.1004L3.16495 8.26698C1.68958 6.79092 1.68958 4.39498 3.16495 2.9196C4.64102 1.44354 7.03764 1.44423 8.5137 2.92029C8.64227 3.04885 8.81758 3.12173 8.99977 3.12173Z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                            <div>
                                <a href="{{ route('product-details.show', $product->id) }}">
                                    @if (!empty($product->images))
                                        <img src="{{ asset('storage/' . $product->images[0]) }}">
                                    @else
                                        <img
                                            src="https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="description">
                            <div class="over_box">
                                <div class="product-name">
                                    <a href="{{ route('product-details.show', $product->id) }}">
                                        <em>{{ $product->agency->name }}</em>{{ $product->name }}
                                    </a>
                                </div>
                                <ul class="price">
                                    @if ($product->stock > 0)
                                        @if ($product->discounted_price)
                                            <li class="price-now">{{ "Rp. $product->discounted_price" }}</li>
                                            <li class="price-before">{{ "Rp. $product->price" }}</li>
                                        @else
                                            <li class="price-now">{{ "Rp. $product->price" }}</li>
                                        @endif
                                    @else
                                        <li class="sold-out">SOLD OUT</li>
                                    @endif
                                </ul>
                                <div class="cart_icon">
                                    <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_135_441)">
                                                    <path
                                                        d="M23.8045 6.65627C23.7357 6.55857 23.6445 6.47883 23.5384 6.42376C23.4324 6.36869 23.3147 6.3399 23.1952 6.33982H7.27795L6.07308 2.18482C5.60058 0.548695 4.4778 0.37207 4.0173 0.37207H0.804679C0.392906 0.37207 0.059906 0.705445 0.059906 1.11682C0.059906 1.5282 0.393281 1.86155 0.804656 1.86155H4.01691C4.11853 1.86155 4.42866 1.86155 4.64018 2.59242L8.78506 17.8253C8.87506 18.1467 9.16793 18.3687 9.50203 18.3687H19.6263C19.9406 18.3687 20.221 18.1718 20.3272 17.8759L23.8957 7.33652C23.9778 7.10815 23.9437 6.8539 23.8046 6.65627H23.8045ZM19.1022 16.8796H10.0673L7.69657 7.8297H22.1363L19.1022 16.8796ZM17.6251 19.8781C16.5893 19.8781 15.7501 20.7173 15.7501 21.7531C15.7501 22.7888 16.5893 23.6281 17.6251 23.6281C18.6608 23.6281 19.5001 22.7888 19.5001 21.7531C19.5001 20.7173 18.6608 19.8781 17.6251 19.8781ZM10.8751 19.8781C9.83932 19.8781 9.00007 20.7173 9.00007 21.7531C9.00007 22.7888 9.83932 23.6281 10.8751 23.6281C11.9108 23.6281 12.7501 22.7888 12.7501 21.7531C12.7501 20.7173 11.9108 19.8781 10.8751 19.8781Z" />
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
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

    function changeBigImage(smallImg) {
        const newImgSrc = smallImg.getAttribute('src');
        const bigImg = document.getElementById('big-image');
        bigImg.setAttribute('src', newImgSrc);
    }
</script>
