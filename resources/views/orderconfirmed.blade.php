@extends('layouts.main')

@section('title', 'Order Confirmed! | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detprod.css') }}">
@endsection


@section('content')
    <center>
        <div style="margin: 10vh 0px 20vh 0px">
            <img src="
                    {{ asset('assets/icon/orderconfimed.svg') }}
                    "
                style="width: 17rem;">
            <h2 style="font-weight: bold;font-size: 2rem;">
                Horray! Your order has been confirmed!
            </h2>
            <p>
                We hope that your purchase brings you joy, happiness, and a sense of
                <br><span style="color:#eab8c0">'Happily Ever After'</span> in your life!
            </p>
            <a href="{{ route('home') }}">
                <div class="base-button" style="position: relative; margin-top:20px">
                    <button class="first" style="display: block; width : 200px">
                        <span>Back to Home</span>
                    </button>
                </div>
            </a>
        </div>
    </center>
@endsection
