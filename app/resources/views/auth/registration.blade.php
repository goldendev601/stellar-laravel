@extends('layouts.authentication.master')
@section('title', 'Sign-up')

@section('css')
<!-- Custom Auth css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/auth.css')}}">
@endsection

@section('style')
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
                    <form action="{{ route('register.doRegistration') }}" method="POST">
                        @csrf
                        <div class="login-main">
                            <form class="theme-form">
                                <h4>Create your account</h4>
                                <p>Enter your personal details to create account</p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="first_name" required=""
                                                placeholder="First name">
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="last_name" required=""
                                                placeholder="Last name">
                                            @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required=""
                                        placeholder="Test@gmail.com">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    {{--                        <div class="show-hide"><span class="show"></span></div>--}}
                                </div>
                                <div class="form-group mb-0">
                                    {{--                        <div class="checkbox p-0">--}}
                                    {{--                           <input id="checkbox1" type="checkbox" required>--}}
                                    {{--                           <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>--}}
                                    {{--                        </div>--}}
                                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                </div>
                                <p class="mt-4 mb-0 alradyHaveAccount">Already have an account?<a class="ms-2"
                                        href="{{ route('login') }}">Sign in</a></p>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script>
@if($message = session('registration-error'))
swal("{{ $message }}");
@endif
@if($message = session('registration-success'))
swal("{{ $message }}");
@endif
</script>
@endsection