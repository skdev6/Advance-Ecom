@extends('layouts.frontend-master')
@section('content')
<div class="container">
    <div class="sign-in-page">
        <div class="row">
            <!-- Sign-in -->
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Sign in</h4>
                <p class="">Hello, Welcome to your account.</p>
                <div class="social-sign-in outer-top-xs">
                    <a href="{{route('login-facebook')}}" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                    <a href="{{route('login-google')}}" class="twitter-sign-in"><i class="fa fa-google"></i> Sign In with Google</a>
                </div>
                <form class="register-form outer-top-xs" role="form" action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control  @error('email') is-invalid @enderror text-input" id="exampleInputEmail1" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input type="password" name="password" class="@error('record') is-invalid @enderror form-control unicase-form-control text-input" id="exampleInputPassword1"  required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                        <div class="radio outer-xs">
                            <label>
                                <input type="checkbox" id="remember" name="remember" id="optionsRadios2" value="option2" {{ old('remember') ? 'checked' : '' }}>
                                {{__("Remember me!")}}
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a> 
                            @endif
                        </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Login') }}</button>
                </form>
                
            </div>
            <!-- Sign-in -->
            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <p class="text title-tag-line">Create your new account.</p>
                <form class="register-form outer-top-xs" role="form" action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="info-title for="resemail">Email Address <span>*</span></label>
                        <input type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror unicase-form-control text-input"
                            required
                            autocomplete="email"
                            autofocus id="resemail"
                        />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title for="resname">Name<span>*</span></label>
                        <input type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror unicase-form-control text-input"
                            required
                            autocomplete="name"
                            autofocus id="resname"
                        />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title for="resname">Phone<span>*</span></label>
                        <input type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror unicase-form-control text-input"
                            required
                            autocomplete="phone"
                            autofocus id="resphone"
                        />
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title for="resname">Password<span>*</span></label>
                        <input type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror unicase-form-control text-input"
                            required
                            autocomplete="password"
                            autofocus id="respassword"
                        />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="password-confirm">Confirm Password <span>*</span></label>
                        <input id="password-confirm" type="password" class="form-control unicase-form-control text-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                </form>
            </div>
            <!-- create a new account -->
        </div>
        <!-- /.row -->
    </div>
    @include('frontend.inc.brand')
</div>
@endsection
