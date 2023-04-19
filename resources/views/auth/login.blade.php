@extends('layouts.front')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Login Tab Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src={{ asset('assets/img/login-banner.png') }} class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{ isset($url) ? ucwords($url) : '' }} {{ __('Login') }}
                                        @if (isset($url) && $url === 'doctor')
                                            <a href={{ url('/login') }}>Not a Doctor?</a>
                                        @else
                                            <a href={{ url('login/doctor') }}>Are you a Doctor?</a>
                                        @endif
                                    </h3>
                                </div>
                                @isset($url)
                                    <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                                    @else
                                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                        @endisset
                                        @csrf
                                        <div class="form-group form-focus">
                                            <input id="email" type="email"
                                                class="form-control floating @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('E-Mail Address') }}</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="password" type="password"
                                                class="form-control floating @error('phone') is-invalid @enderror"
                                                name="password" value="{{ old('password') }}" required
                                                autocomplete="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Password') }}</label>
                                        </div>
                                        <div class="form-group">
                                            <input class="" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <div class="text-right">
                                            @if (Route::has('password.request'))
                                                <a class="forgot-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary btn-block btn-lg login-btn"
                                            type="submit">{{ __('Login') }}</button>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <span class="span-or">or</span>
                                        </div>
                                        <div class="row form-row social-login">
                                            <div class="col-6">
                                                <a href="{{ url('auth/facebook') }}" class="btn btn-facebook btn-block"><i
                                                        class="fab fa-facebook-f mr-1"></i> Login</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ url('auth/google') }}"class="btn btn-google btn-block"><i
                                                        class="fab fa-google mr-1"></i> Login</a>
                                            </div>
                                        </div>
                                        <div class="text-center dont-have">Don’t have an account?
                                            @if (isset($url) && $url === 'doctor')
                                                <a href={{ url('register/doctor') }}>Register</a>
                                            @else
                                                <a href={{ url('register') }}>Register</a>
                                            @endif
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Login Tab Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
