@extends('layouts.authentication.master')
@section('title', 'Reset Password')

@section('css')
@endsection
  
@section('content')

<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
               <div><a class="logo" href="{{ route('/') }}"><img class="img-fluid for-light" src="{{ asset('assets/images/logo.svg') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('assets/images/logo.svg') }}" alt="looginpage"></a></div>
               <div class="login-main">
                  <form class="theme-form" action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                     <h4>Reset Password</h4>
                     <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" name="email" required placeholder="Enter your email address" autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" id="txtpassword" name="password" required placeholder="Enter your password">
                        @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                        
                     </div>

                     <div class="form-group">
                        <label class="col-form-label">Confirm Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Enter Confirm password">
                        @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                        
                     </div>

                     <div class="form-group mb-0">
                        <button class="btn btn-primary login-btn" type="submit">Reset Password</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection