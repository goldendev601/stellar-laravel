@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
<!-- Custom Auth css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/auth.css')}}">
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div><a class="logo" href="{{ route('/') }}"><img class="img-fluid for-light"
                                src="{{ asset('assets/images/logo.svg') }}" alt="looginpage"><img
                                class="img-fluid for-dark" src="{{ asset('assets/images/logo.svg') }}"
                                alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" action="{{ route('login.doLogin') }}" method="POST">
                            @csrf
                            @if (session()->has('success'))
                            <div id="success-meg">
                                <strong>
                                    {!! session()->get('success') !!}
                                </strong>
                            </div>
                            @endif
                            <h4>Login to your account</h4>
                            <p>Enter your email & password to login</p>
                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" type="email" name="email" required
                                    placeholder="Enter your email address">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <input class="form-control" type="password" id="txtpassword" name="password" required
                                    placeholder="Enter your password">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <div class="show-hide"><i class="far fa-eye" id="togglePassword"></i></div>

                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox" class="border-primary">
                                    <label class="text-primary ps-2" for="checkbox1">Remember me</label>
                                </div>
                                <a class="link text-primary forgot-pass-link" href="/forgotpassword">Forgot
                                    password?</a>
                                <button class="btn btn-primary login-btn" type="submit">Login</button>
                            </div>
                            <p class="mt-4 mb-0 text-center text-gray dontHaveAccount">Don't have account?<a
                                    class="ms-2 text-primary text-underline" href="/registration">Create Account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
<div id="snackbar">
    {{ $errors->first() }}
</div>
@endif
@if (session()->has('message'))
<div id="snackbar">
    {{ session()->get('message') }}
</div>
@endif
@endsection