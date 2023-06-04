@extends('layouts.main')

@section('title', 'Profile | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="wrapper user-wrap">
        <div class="user-container">
            @include('layouts.userprofile')
            <div class="width1140">
                @include('layouts.userside')
                <div id="user-main">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        <div class="user-edit">
                            <h3 class="side_title">
                                Personal Profile
                                <span class="required"><em class="ico_required">*</em> Required input</span>
                            </h3>
                            <div class="user-table">
                                <table border="0" summary="">
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Name
                                            </th>
                                            <td>
                                                <input placeholder="Name" id="name" name="name" class="form-control"
                                                    value="{{ $user->name }}" type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Email
                                            </th>
                                            <td>
                                                <input placeholder="Email" id="email" type="email"
                                                    class="form-control" name="email"value="{{ $user->email }}"
                                                    type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Phone
                                            </th>
                                            <td>
                                                <input placeholder="Phone Number" id="phone" name="phone"
                                                    class="form-control" value="{{ $user->phone }}"type="text" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <em class="ico_required">*</em>Password
                                            </th>
                                            <td>
                                                <input placeholder="Password" id="password" type="password" name="password"
                                                    required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="clear-both user-buttons">
                                <a href="{{ route('home') }}" class="button-cancel btnripple">Cancel</a>
                                <button type="submit" class="button-confirm btnripple">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
