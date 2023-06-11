@extends('layouts.main')

@section('title', 'Page Not Found | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detprod.css') }}">
@endsection


@section('content')
    <center>
        <div style="padding: 5vh 0 8vh 0;display: flex;justify-content: center;flex-direction: row;align-items: center;">
            <img src="{{ asset('assets/icon/405.svg') }}" style="width: 20rem;">
            <div style="width: 25vw">
                <h1 style="font-weight: bold;font-size: 8rem;padding-top:5px">
                    405
                </h1>
                <span style="color: #eab8c0">Naugthy, naughty!</span> You can't do that.
                <br>

                <a href="{{ route('home') }}">
                    <div class="base-button" style="position: relative; margin-top:20px">
                        <button class="first" style="display: block; width : 200px">
                            <span>Back to Home</span>
                        </button>
                    </div>
                </a>
            </div>
        </div>
    </center>
@endsection
