@extends('layouts.main')

@section('title', config('app.name') . ' | Your one-stop K-pop shop!')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/webflow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider.css') }}">
    <style>
        .text-contain {
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="hero">
        <div class="hero hero--750px hero--mobile--auto">
            <div class="hero__media">
                <iframe title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    src="https://www.youtube.com/embed/LOmz1O5Inx0?autoplay=1&enablejsapi=1&controls=0&disablekb=1&mute=1&loop=1&playlist=LOmz1O5Inx0"></iframe>
            </div>
        </div>
        <div class="hero-content">
            <h1>WENDY - LIKE WATER</h1>
            <p>1st Mini Album</p>
            <a href="{{ route('product-details.show', ['product' => 1]) }}" class="btn-shop-now">Buy Now</a>
        </div>
    </div>
    <div class="main_section2" style="margin: 50px auto auto auto; padding-top: 55px">
        <center>
            <h1 style="font-size: 2.5em">Top Sales</h1>
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
                                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
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
    <div class="w-embed">
        <style>
            .item:nth-child(n) .bg-color {
                background-color: #fbe3e4;
            }
        </style>
    </div>
    <div class="section is--slider">
        <h1 style="font-size: 2.5em;margin: 0px auto 35px">Agency</h1>
        <div class="slider_contain">
            <div class="wrapper w-dyn-list">
                <div id="slider-id" role="list" class="list w-dyn-items">
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 1]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/sm.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>SM Ent.</h4>
                            </div>
                        </a>
                    </div>
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 2]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/jyp.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>JYP Ent.</h4>
                            </div>
                        </a>
                    </div>
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 3]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/yg.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>YG Ent.</h4>
                            </div>
                        </a>
                    </div>
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 4]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/hybe.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>HYBE Corp.</h4>
                            </div>
                        </a>
                    </div>
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 5]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/cube.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>Cube Ent.</h4>
                            </div>
                        </a>
                    </div>
                    <div role="listitem" class="item w-dyn-item">
                        <div class="bg-color"></div>
                        <a href="{{ route('products.agency', ['agencyId' => 6]) }}" class="card w-inline-block">
                            <div class="embed w-embed">
                                <div data-autoplay="true" data-loop="true"
                                    class="video w-background-video w-background-video-atom">
                                    <video autoplay="" loop="" muted="" playsinline=""
                                        data-object-fit="cover">
                                        <source src="{{ asset('assets/agency/others.mp4') }}" data-wf-ignore="true">
                                    </video>
                                </div>
                            </div>
                            <div class="text-contain">
                                <h4>Others</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: #ECE2F0; padding : 10px 0 50px 0; margin: 50px 0 100px 0; overflow-x: hidden">
        <center>
            <h1 style="font-size: 2.5em;margin: 40px auto 0px">New Releases</h1>
        </center>
        <div class="section">
            <div class="slider-container">
                <div class="slider-wrapper">
                    <div data-animation="slide" data-hide-arrows="1" data-duration="500" class="slider w-slider">
                        <div class="mask w-slider-mask">
                            <div class="slide w-slide">
                                <img src="https://media.discordapp.net/attachments/828120769903984670/1115469495675392070/FtyyFPHacAAPDgl.png"
                                    alt="" class="slide-content-wrapper">
                            </div>
                            <div class="slide w-slide">
                                <img src="https://cdn.discordapp.com/attachments/828120769903984670/1115463946850283550/FlHRaM6aEAEYrbX.jpg"
                                    alt="" class="slide-content-wrapper">
                            </div>
                            <div class="slide w-slide">
                                <img src="https://cdn.discordapp.com/attachments/828120769903984670/1115470010949840906/5969d635ce6eb8f51b1da79d7140cfcd.png"
                                    alt="" class="slide-content-wrapper">
                            </div>
                            <div class="slide w-slide">
                                <img src="https://cdn.discordapp.com/attachments/828120769903984670/1115470458947633254/ab67616d0000b273e08c3c6ffdd7ed782323d1b9.png"
                                    alt="" class="slide-content-wrapper">
                            </div>
                        </div>
                        <div class="slider-left-arrow w-slider-arrow-left">
                            <div class="slider-icon w-icon-slider-left"></div>
                        </div>
                        <div class="slider-right-arrow w-slider-arrow-right">
                            <div class="slider-icon w-icon-slider-right"></div>
                        </div>
                        <div class="w-slider-nav w-round"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=5f91d148171fba571bd8b1e9"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <script src="https://assets.website-files.com/5f91d148171fba571bd8b1e9/js/cms-draggable-slider.a78e7f552.js"
        type="text/javascript"></script>
    <script src="https://assets.website-files.com/5df0e1d5c2f6ed42db3a3f5e/js/webflow.e87bb3f9f.js" type="text/javascript">
    </script>
    <script>
        var Webflow = Webflow || [];
        Webflow.push(function() {
            var figure = $(".video").hover(function() {
                $('video', this).get(0).play();
            }, function() {
                $('video', this).get(0).pause();
            }).each(function() {
                $('video', this).get(0).pause();
            });
        });
    </script>
    <script>
        $(function() {

            $(".item").mouseenter(function() {
                var myBG = $(this).children('.bg-color').css("background-color");
                $("body").css("background-color", myBG);
            });

            $(".item").mouseleave(function() {
                $("body").css("background-color", "#fafafa");
            });

        });
    </script>
    <style>
        .item {
            display: inline-block;
        }

        .list {
            display: block !important;
        }

        .slick-prev:hover,
        .slick-prev:focus,
        .slick-next:hover,
        .slick-next:focus {
            outline: none;
        }

        .slick-slide,
        .slick-slide * {
            outline: none !important;
        }
    </style>


@endsection
