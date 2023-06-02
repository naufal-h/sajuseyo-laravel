@php
    $overallSubtotal = 0;
@endphp

@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')
    <form action="{{ route('checkout.place_order') }}" method="POST">
        @csrf
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
                        <div class="checkout-top-info-change">Change</div>
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
                                    <div>Reguler</div>
                                </div>

                                <div class="checkout-main-ship-est">Receive by 30 - 31 Feb</div>
                                <div class="checkout-main-ship-change">Change</div>
                                <div class="checkout-main-ship-cost">Rp. 20.000</div>
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
            <div class="checkout-payment-wrap">
                <div class="checkout-payment-content">
                    <div class="checkout-payment-left-wrap">
                        <div class="checkout-payment-left">
                            <div class="checkout-payment-title">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.8607 1.20791C17.6964 1.22036 17.5338 1.26357 17.3802 1.34033L15.0001 2.47588L12.5779 1.31924L12.5439 1.30869C12.0001 1.12744 11.2534 1.24165 10.8564 1.8372L9.30367 3.92431L6.60601 3.97939L6.56499 3.98642C6.01909 4.07741 5.40687 4.48551 5.30523 5.19697L5.3064 5.18408L4.87398 7.78564L2.43648 9.11455L2.39663 9.14619C1.92693 9.52195 1.63136 10.1492 1.84937 10.8032L1.85054 10.8067L2.7189 13.3052L1.31617 15.5177C0.93566 16.0884 1.04517 16.8662 1.50952 17.3306L1.51187 17.3341L3.41851 19.1856L3.20054 21.8528L3.20523 21.8177C3.1003 22.5521 3.59775 23.1509 4.19663 23.3505L4.2107 23.3552L6.77476 24.0653L7.81187 26.5228L7.82007 26.5392C8.12712 27.1533 8.77805 27.4355 9.39624 27.3325L9.40679 27.3313L12.0271 26.7853L14.1142 28.488L14.1376 28.5032C14.392 28.6728 14.691 28.781 15.0001 28.781C15.3093 28.781 15.6338 28.6875 15.8908 28.4306L15.8474 28.4704L17.9123 26.7853L20.522 27.329L20.481 27.3185C21.1821 27.5188 21.8481 27.084 22.1205 26.5392L22.1287 26.5228L23.1658 24.0653L25.7298 23.3552L25.7439 23.3505C26.3428 23.1509 26.8402 22.5521 26.7353 21.8177L26.7388 21.8528L26.522 19.1856L28.4251 17.3364L28.383 17.3739C28.9486 16.9214 29.0523 16.1094 28.5939 15.5364L28.6314 15.588L27.2169 13.3591L28.0361 10.8501L28.0384 10.8395C28.2147 10.2228 28.017 9.45893 27.3798 9.14033L25.1275 7.85244L24.6939 5.24385L24.6951 5.25791C24.6022 4.6078 24.0371 4.03916 23.3404 4.03916H23.3638L20.7013 3.93017L19.1439 1.8372C18.9536 1.55183 18.6659 1.35086 18.3494 1.25947C18.1911 1.21378 18.025 1.19546 17.8607 1.20791ZM17.9744 2.35283C18.0437 2.33908 18.1025 2.3698 18.1771 2.48174L18.1853 2.49463L20.099 5.06924L23.3287 5.20049H23.3404C23.4837 5.20049 23.5183 5.23207 23.5455 5.42197V5.429L24.0728 8.58721L26.8455 10.1728L26.8607 10.1798C26.9432 10.221 26.9845 10.297 26.9216 10.5185V10.5196L25.9431 13.5196L27.6669 16.2384L27.6869 16.263C27.7085 16.29 27.692 16.4382 27.6576 16.4657L27.6353 16.4833L27.6154 16.5032L25.3185 18.7333L25.5822 21.9642L25.5845 21.9817C25.5995 22.0867 25.4974 22.2068 25.3771 22.2478L22.3138 23.095L21.0787 26.0212C20.9918 26.1943 20.938 26.24 20.7998 26.2005L20.7798 26.1946L17.6076 25.5349L15.0904 27.588L15.0693 27.6091C15.0863 27.5921 15.051 27.6185 15.0001 27.6185C14.9517 27.6185 14.8893 27.6018 14.7927 27.5399L12.333 25.5349L9.20406 26.1864C9.10295 26.2033 8.91631 26.126 8.86187 26.0212L7.62554 23.095L4.56226 22.2466C4.44235 22.2053 4.33988 22.0865 4.35484 21.9817L4.35835 21.9642L4.62202 18.7333L2.33101 16.5091C2.19537 16.3734 2.18464 16.3114 2.28413 16.1622L2.28765 16.1563L4.00093 13.454L2.95093 10.4364V10.4353C2.93021 10.3712 2.99677 10.1747 3.11734 10.0673L5.92632 8.53447L6.45484 5.36806V5.3622C6.47268 5.23733 6.58235 5.1701 6.74781 5.13955L9.89663 5.0751L11.815 2.49463L11.8232 2.48174C11.9045 2.35976 11.9993 2.35752 12.1689 2.4126L15.0001 3.76377L17.8947 2.38213L17.9005 2.37978C17.927 2.36655 17.9512 2.35741 17.9744 2.35283ZM11.7001 8.39971C10.7401 8.39971 10.0197 8.93994 9.71968 9.83994C9.59968 10.1999 9.60015 10.3797 9.60015 11.6997C9.60015 13.0197 9.65968 13.2595 9.71968 13.5595C10.0197 14.3995 10.7401 14.9997 11.7001 14.9997C12.6601 14.9997 13.3806 14.4595 13.6806 13.5595C13.8006 13.1995 13.8001 13.0197 13.8001 11.6997C13.8001 10.3797 13.7406 10.1399 13.6806 9.83994C13.3806 8.99994 12.6601 8.39971 11.7001 8.39971ZM18.2404 8.39971C18.0604 8.39971 18.0004 8.46017 17.9404 8.58017L10.8599 21.4192C10.7999 21.4792 10.8606 21.5997 10.9806 21.5997H11.8197C11.9397 21.5997 11.9999 21.5392 12.0599 21.4192L19.2001 8.58017C19.2001 8.52017 19.2006 8.39971 19.0806 8.39971H18.2404ZM11.7001 9.65947C12.1201 9.65947 12.4204 9.89947 12.5404 10.2595C12.6004 10.4395 12.6001 10.6195 12.6001 11.7595C12.6001 12.8395 12.5404 13.0197 12.5404 13.1997C12.4204 13.6197 12.1201 13.7997 11.7001 13.7997C11.2801 13.7997 10.9799 13.5597 10.8599 13.1997C10.7999 13.0197 10.8001 12.8395 10.8001 11.7595C10.8001 10.6195 10.8599 10.4395 10.8599 10.2595C10.9799 9.83947 11.2801 9.65947 11.7001 9.65947ZM18.3001 14.9997C17.3401 14.9997 16.6197 15.5399 16.3197 16.4399C16.1997 16.7999 16.2001 16.9797 16.2001 18.2997C16.2001 19.6197 16.2597 19.8595 16.3197 20.1595C16.6197 20.9995 17.3401 21.5997 18.3001 21.5997C19.2601 21.5997 19.9806 21.0595 20.2806 20.1595C20.4006 19.7995 20.4001 19.6197 20.4001 18.2997C20.4001 16.9797 20.3406 16.7399 20.2806 16.4399C19.9806 15.5999 19.2601 14.9997 18.3001 14.9997ZM18.3001 16.2595C18.7201 16.2595 19.0204 16.4995 19.1404 16.8595C19.2004 17.0395 19.2001 17.2195 19.2001 18.3595C19.2001 19.4395 19.1404 19.6197 19.1404 19.7997C19.0204 20.2197 18.7201 20.3997 18.3001 20.3997C17.8801 20.3997 17.5799 20.1597 17.4599 19.7997C17.3999 19.6197 17.4001 19.4395 17.4001 18.3595C17.4001 17.2195 17.4599 17.0395 17.4599 16.8595C17.5799 16.4395 17.8801 16.2595 18.3001 16.2595Z"
                                        fill="#EAB8C0" />
                                </svg>

                                <span class="checkout-payment-title-text">Voucher</span>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-payment-right">
                        <button class="checkout-payment-choose">Choose Voucher</button>
                    </div>
                </div>
                <div class="checkout-payment-content">
                    <div class="checkout-payment-left-wrap">
                        <div class="checkout-payment-left">
                            <div class="checkout-payment-title">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_648_306)">
                                        <path
                                            d="M12.3751 5.40039C11.5055 5.40039 10.7977 5.83164 10.3313 6.37539C10.2094 6.51602 10.104 6.67305 10.0126 6.82539C9.72429 6.71523 9.43601 6.65195 9.16882 6.63789C8.72585 6.6168 8.32976 6.71289 7.98757 6.90039C7.30554 7.27539 6.82507 7.84492 6.31882 8.26914C5.80085 8.70273 4.25164 9.8418 2.86882 10.8379C1.48601 11.834 0.262574 12.7129 0.262574 12.7129C0.0492925 12.816 -0.0819576 13.034 -0.0749262 13.2707C-0.0678948 13.5074 0.0774174 13.7184 0.295387 13.8074C0.515699 13.8988 0.76648 13.852 0.937574 13.6879C0.937574 13.6879 2.19382 12.8137 3.58132 11.8129C4.96882 10.8121 6.48523 9.7082 7.10632 9.18789C7.70867 8.68164 8.17273 8.16836 8.56882 7.95039C8.89695 7.76992 9.1571 7.71133 9.63757 7.95039C9.6282 8.03242 9.60007 8.11211 9.60007 8.19414V15.3379L8.77507 15.7129C8.55476 15.7809 8.39304 15.973 8.36023 16.2004C8.32742 16.4301 8.43054 16.6574 8.62273 16.7863C8.81492 16.9129 9.06335 16.9199 9.26257 16.8004L14.8126 14.2504H14.8313C15.6212 13.8285 16.4485 13.4418 17.0813 13.3129C17.7141 13.184 18.0305 13.2379 18.3001 13.5941C18.6165 14.0113 18.6891 14.4707 18.5438 14.9816C18.3985 15.4926 18.0118 16.0457 17.3438 16.5191C15.9446 17.5082 13.7813 18.2441 13.7813 18.2441L13.6688 18.2816L13.5751 18.3566C12.4618 19.3035 11.8173 20.2035 11.0063 20.8129C10.1954 21.4223 9.19226 21.8254 7.12507 21.8254H7.08757L0.562574 22.2004C0.232105 22.2215 -0.02102 22.5074 7.37622e-05 22.8379C0.0211675 23.1684 0.307105 23.4215 0.637574 23.4004L7.12507 23.0254C7.13914 23.0254 7.14851 23.0254 7.16257 23.0254C8.69539 23.0207 9.80867 22.7676 10.6876 22.3691C10.8399 22.8191 11.154 23.2035 11.6438 23.3629C12.3329 23.5855 13.0126 23.5199 13.5563 23.2879C13.7977 23.1848 14.018 23.0441 14.2126 22.8941C14.4024 23.3301 14.7423 23.7379 15.2626 23.9254C15.8087 24.1223 16.3524 24.1668 16.8376 24.0379C17.3227 23.909 17.7188 23.6348 18.0938 23.2879C18.1571 23.2293 18.1993 23.1848 18.2438 23.1379C18.3704 23.2246 18.5157 23.2832 18.6751 23.3254C19.4532 23.5293 20.3626 23.3066 21.0563 22.6129C21.6657 22.0035 22.0313 21.0684 22.1626 19.8004H27.3938C28.8352 19.8004 30.0001 18.6191 30.0001 17.1754V8.13789C30.0001 6.6332 28.7016 5.40039 27.2251 5.40039H12.3751ZM12.3751 6.60039H27.2251C27.9727 6.60039 28.8001 7.39961 28.8001 8.13789V8.40039H10.8001V8.19414C10.8001 7.9457 10.9618 7.49805 11.2501 7.16289C11.5384 6.82773 11.9016 6.60039 12.3751 6.60039ZM10.8001 10.8004H28.8001V17.1754C28.8001 17.9746 28.1766 18.6004 27.3938 18.6004H16.0688C16.6993 18.3121 17.3954 17.9676 18.0376 17.5129C18.8884 16.9105 19.4719 16.1488 19.7063 15.3191C19.9407 14.4895 19.793 13.5918 19.2563 12.8816C18.6704 12.1082 17.7001 11.9746 16.8376 12.1504C15.9868 12.3238 15.1173 12.7316 14.3063 13.1629C14.2946 13.1699 14.2805 13.1746 14.2688 13.1816L10.8001 14.7754V10.8004ZM13.8001 19.8004H14.2126C14.1774 20.2223 14.1165 20.8574 14.0438 21.2629C14.0344 21.3121 14.0321 21.3613 14.0251 21.4129C13.9923 21.434 13.9594 21.4598 13.9313 21.4879C13.6735 21.7949 13.3759 22.0504 13.0688 22.1816C12.7618 22.3129 12.4548 22.3598 12.0188 22.2191C11.911 22.184 11.7891 22.0105 11.7751 21.7316C12.5485 21.141 13.118 20.4707 13.8001 19.8004ZM15.4313 19.8004H17.6813C17.6391 20.0793 17.6016 20.398 17.5688 20.7191C17.529 21.1105 17.4938 21.5793 17.5876 22.0504C17.5548 22.0949 17.5407 22.1043 17.4938 22.1629C17.3954 22.2871 17.2196 22.4676 17.2876 22.4066C16.9923 22.6785 16.7438 22.8332 16.5188 22.8941C16.2938 22.9551 16.0571 22.9387 15.6751 22.8004C15.4712 22.7277 15.3657 22.5965 15.2813 22.3504C15.1969 22.1043 15.1735 21.7551 15.2251 21.4691C15.3282 20.902 15.4009 20.1777 15.4313 19.8004ZM18.9001 19.8004H20.9438C20.8196 20.8035 20.5407 21.441 20.2126 21.7691C19.7673 22.2168 19.3899 22.2707 18.9751 22.1629C18.8368 22.1254 18.8251 22.0926 18.7688 21.8441C18.7126 21.5957 18.7126 21.2066 18.7501 20.8504C18.7899 20.466 18.8485 20.0934 18.9001 19.8004Z"
                                            fill="#EAB8C0" />
                                    </g>
                                </svg>

                                <span class="checkout-payment-title-text">Payment Method</span>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-payment-right">
                        <button class="checkout-payment-choose">
                            Choose Payment Method
                        </button>
                    </div>
                </div>
            </div>
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
                        Rp. 20.000
                    </div>

                    <div class="checkout-bottom-item checkout-bottom-item-left cart-total">
                        Total:
                    </div>
                    <div class="checkout-bottom-item kC0GSn checkout-bottom-item-right cart-total">
                        Rp. 1.070.000
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
@endsection
