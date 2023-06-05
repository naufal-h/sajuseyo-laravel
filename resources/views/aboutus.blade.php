@extends('layouts.main')

@section('title', 'About Us | ' . config('app.name'))

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
                        customer service and connect fans nationwide. Thank you for choosing Sajuseyo, the dazzling K-POP
                        emporium that will make your heart go, <span style="color:#eab8c0">"Gee gee gee gee, baby baby
                            baby!"</span>
                        <br>
                    </p>
                    <a href="{{ route('home') }}" class="button button-space about-button">Start Shopping Now!</a>
                    <p style="font-size: 0.7rem">*Note : Our office are based in South Tangerang, Banten <br> and the
                        shipping
                        fee
                        is calculated from
                        there.</p>
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
    <div>
        <center>
            <div style="padding: 5vh 0 8vh 0;background-color: white">
                <img src="{{ asset('assets/icon/abotus.svg') }}" style="width: 23rem;">
                <h2 style="font-weight: bold;font-size: 1.8rem;padding-top:5px">
                    Hi there! <span style="color:#eab8c0">We are Sajuseyo!</span>
                </h2>
                <p>
                    This website is made for educational purposes only. <br> The content
                    displayed on this website is not real and is not intended to be
                    used for any commercial purpose. <br> All images used belong to their
                    respective
                    owners.
                    <br> Thank you for visiting our website!
                </p>
            </div>
        </center>

    </div>
@endsection
