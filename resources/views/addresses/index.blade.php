@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
    <div class="wrapper user-wrap">
        <div class="user-container">
            @include('layouts.userprofile')
            <div class="width1140">
                @include('layouts.userside')
                <div class="address-main" role="main">
                    <div style="display: contents">
                        <div class="address-main-wrap">
                            <div class="address-main-top">
                                <div class="address-main-top-title">
                                    <div class="my-addresses-top">My Addresses</div>
                                </div>
                                <div>
                                    <div class="add-address-wrap">
                                        <div style="display: flex">
                                            <button class="btn-addnew-addr">
                                                <div>Add New Address</div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="address-main-content-bg">
                                <div class="address-main-content-wrap">
                                    @foreach ($addresses as $address)
                                        <div class="address-main-card address-main-card-padding">
                                            <div class="address-main-card-width">
                                                <div role="heading" class="address-main-card-margin address-main-card-flex">
                                                    <div class="address-main-card-mar address-main-card-content">
                                                        <span class="address-main-card-font address-main-card-alignfont">
                                                            <div class="address-main-card-namae">
                                                                {{ $address->name }}
                                                            </div>
                                                        </span>
                                                        <div class="address-main-card-split"></div>
                                                        <div role="row"
                                                            class="address-main-card-whspc address-main-card-rgba address-main-card-children">
                                                            {{ $address->phone }}
                                                        </div>
                                                    </div>
                                                    <div class="address-main-card-lasto">
                                                        <button class="address-main-card-lasto-btn">
                                                            Edit</button>
                                                        <form action="{{ route('address.destroy', $address->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="address-main-card-lasto-btn">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div role="heading" class="address-main-card-margin address-main-card-flex">
                                                    <div class="address-main-card-mar address-main-card-content">
                                                        <div class="address-main-card-turu">
                                                            <div role="row" class="address-main-card-children">
                                                                {{ $address->address }}
                                                            </div>
                                                            <div role="row" class="address-main-card-children">
                                                                {{ $address->city }},
                                                                {{ $address->province }},
                                                                {{ $address->postal_code }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="address-main-card-padtop address-main-card-lasto">
                                                        @if ($address->is_default == 0)
                                                            <form
                                                                action="{{ route('addresses.set_default', $address->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button
                                                                    class="address-main-card-default address-main-card-default-sty address-main-card-default-bg">
                                                                    Set as default
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button
                                                                class="address-main-card-default address-main-card-default-sty address-main-card-default-bg"
                                                                disabled>
                                                                Set as default
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if ($address->is_default == 1)
                                                    <div role="row"
                                                        class="address-main-card-target address-main-card-children">
                                                        <span role="mark"
                                                            class="address-def-bar address-isdef address-isdef-border">Default</span>
                                                    </div>
                                                @endif
                                                <div role="row"
                                                    class="address-main-card-target address-main-card-children"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
