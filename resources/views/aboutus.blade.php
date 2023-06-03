@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/aboutus.css') }}">
@endsection

@section('content')
    <div class="header-section">
        <div class="container-flex">
            <div class="title-wrap-centre">
                <h1 class="header-h1">
                    Your One-Stop <br />
                    <span class="brand-span">K-POP Shop!</span>
                </h1>
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="container">
            <div class="about-layout-grid content-grid">
                <div class="content-block">
                    <h2>
                        Discover<br /><span class="brand-span">K-POP</span> Paradise
                    </h2>
                    <p>
                        Sajuseyo! is the ultimate destination for K-POP fans in Indonesia,
                        offering a wide selection of merchandise, albums, and accessories
                        from your favorite artists. Our goal is to provide exceptional
                        customer service and connect fans nationwide. Thank you for
                        choosing Sajuseyo!, your one-stop K-POP shop.
                    </p>
                    <a href="{{ route('home') }}" class="button button-space about-button">Start Shopping Now!</a>
                </div>
                <div class="image-block">
                    <img src="/assets/svg/agency.svg" alt="" />
                </div>
            </div>
        </div>
    </div>
    <div class="full-image">
        <div class="container">
            <div class="about-layout-grid grid-3">
                <div class="statistic-block">
                    <h1 class="statistic">100</h1>

                    <div class="text-block">
                        Explore our vast selection of 100+ exclusive K-Pop items!
                    </div>
                </div>
                <div class="statistic-block">
                    <h1 class="statistic">24/7</h1>

                    <div class="text-block">
                        Shop anytime, anywhere with our 24/7 online store!
                    </div>
                </div>
                <div class="statistic-block">
                    <h1 class="statistic">20+</h1>

                    <div class="text-block">
                        We carry over 20+ popular K-Pop groups' merchandise!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
