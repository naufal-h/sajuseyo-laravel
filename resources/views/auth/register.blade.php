@extends('layouts.forms')

@section('content')
    <div class="formpagewrap page-wrapper">
        <div class="formwrapper card form pages masup">
            <form action="{{ route('register.submit') }}" method="POST" class="text-center">
                <div class="formheader">
                    <h1 class="heading-h2-size">Sign Up</h1>
                </div>
                @csrf
                <div class="layout-grid grid-1-column">

                    <label for="name">{{ __('Full Name') }}</label>
                    <input id="name" type="text" class="input form-control" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="input form-control" name="email"
                        value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input id="phone" type="text" class="input form-control" name="phone"
                        value="{{ old('phone') }}" required autocomplete="phone">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="input form-control " name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" class="input form-control"
                        name="password_confirmation" required>
                    <div class="top-opt">
                        <div class="form-block form">
                            <label class="checkbox checkbox-field">
                                <input type="checkbox" id="checkbox" name="checkbox" data-name="Checkbox"
                                    class="checkbox-input checkbox-2" required="" />
                                <p class="checkbox-label form-label" for="checkbox">
                                    Agree with
                                    <a href="tnc" class="sign-up">Terms &amp; Conditions</a>
                                </p>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="formbutton btn-primary button">
                        {{ __('Register') }}
                    </button>
                    <p class="bottom-opt">
                        Already have an account?
                        <a class="sign-up" href="login">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
