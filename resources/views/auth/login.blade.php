@extends('layouts.forms')

@section('content')
    <div class="formpagewrap page-wrapper">
        <div class="formwrapper card form pages masup">
            <form action="{{ route('login.submit') }}" method="POST" class="text-center">
                <div class="formheader">
                    <h1 class="heading-h2-size">Sign In</h1>
                </div>
                @csrf

                <div class="layout-grid grid-1-column">

                    <input id="email" type="email" placeholder="Email" class="input form-control" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <input id="password" type="password" placeholder="Password" class="input form-control " name="password"
                        required autocomplete="current-password">

                    @if ($errors->has('login'))
                        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                    @endif
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="top-opt">
                        <div class="form-block form">
                            <label class="checkbox checkbox-field" for="remember">

                                <input class="checkbox-input checkbox-2" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <p class="checkbox-label form-label" for="checkbox">
                                    Remember me
                                </p>
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="fgt-pass" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="formbutton btn-primary button">Login</button>
                </div>
                <p class="bottom-opt">
                    Don't have account?
                    <a class="sign-up" href="register">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
@endsection
