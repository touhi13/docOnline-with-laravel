
@extends('layouts.front')

@push('styles')
    <style>
        input[type=date]:required:invalid::-webkit-datetime-edit {
            color: transparent;
        }

        input[type=date]:focus::-webkit-datetime-edit {
            color: black !important;
        }
    </style>
@endpush

@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Account Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src={{ asset('assets/img/login-banner.png') }} class="img-fluid" alt="Login Banner">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{ isset($url) ? ucwords($url) : '' }} {{ __('Register') }} 
                                        @if (isset($url) && $url === 'doctor')
                                        <a href={{url('/register')}}>Not a Doctor?</a>
                                        @else
                                        <a href={{url('register/doctor')}}>Are you a Doctor?</a>
                                        @endif
                                    </h3>
                                </div>
                                <!-- Register Form -->
                                @isset($url)
                                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                                    @else
                                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                        @endisset
                                        @csrf
                                        @if (isset($url) && $url === 'doctor')
                                        <div class="form-group form-focus">
                                            <select id="title"
                                                class="form-control floating @error('title') is-invalid @enderror"
                                                name="title" value="{{ old('title') }}" required autocomplete="title"
                                                autofocus>
                                                <option hidden></option>
                                                <option value="Dr.">
                                                    Dr.
                                                </option>
                                                <option value="Prof. Dr.">
                                                    Prof. Dr.
                                                </option>
                                                <option value="Assoc. Prof. Dr.">
                                                    Assoc. Prof. Dr.
                                                </option>
                                                <option value="Asst. Prof. Dr.">
                                                    Asst. Prof. Dr.
                                                </option>
                                            </select>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Title') }}</label>
                                        </div>
                                        @endif
                                        <div class="form-group form-focus">
                                            <input id="first_name" type="text"
                                                class="form-control floating @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ old('first_name') }}" required
                                                autocomplete="first_name" autofocus>

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('First Name') }}</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="last_name" type="text"
                                                class="form-control floating @error('last_name') is-invalid @enderror"
                                                name="last_name" value="{{ old('last_name') }}" required
                                                autocomplete="last_name" autofocus>

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Last Name') }}</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="date_of_birth" type="date"
                                                class="form-control floating @error('date_of_birth') is-invalid @enderror"
                                                name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                                autocomplete="date_of_birth" autofocus>
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Date of Birth') }}</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <select id="gender"
                                                class="form-control floating @error('gender') is-invalid @enderror"
                                                name="gender" value="{{ old('gender') }}" required autocomplete="gender"
                                                autofocus>
                                                <option hidden></option>
                                                <option value="Male">
                                                    Male
                                                </option>
                                                <option value="Female">
                                                    Female
                                                </option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Gender') }}</label>
                                        </div>
                                        @if (isset($url) && $url === 'doctor')
                                            <div class="form-group form-focus">
                                                <select id="district"
                                                    class="form-control floating @error('district') is-invalid @enderror"
                                                    name="district" value="{{ old('district') }}" required
                                                    autocomplete="district" autofocus>
                                                    <option hidden></option>
                                                    @foreach ($districts as $key => $value)
                                                        <option value={{ $value }}>{{ $key }}</option>
                                                    @endforeach
                                                </select>
                                                @error('district')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label class="focus-label">{{ __('District') }}</label>
                                            </div>
                                            <div class="form-group form-focus">
                                                <input id="nid" type="text"
                                                    class="form-control floating @error('nid') is-invalid @enderror"
                                                    name="nid" value="{{ old('nid') }}" required autocomplete="nid">
                                                @error('nid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label class="focus-label">{{ __('National ID') }}</label>
                                            </div>
                                            <div class="form-group form-focus">
                                                <input id="regno" type="text"
                                                    class="form-control floating @error('regno') is-invalid @enderror"
                                                    name="regno" value="{{ old('regno') }}" required
                                                    autocomplete="regno">
                                                @error('regno')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label class="focus-label">{{ __('Registration Number (BMDC)') }}</label>
                                            </div>
                                        @endif
                                        <div class="form-group form-focus">
                                            <input id="phone" type="text"
                                                class="form-control floating @error('phone') is-invalid @enderror"
                                                name="phone" value="{{ old('phone') }}" required
                                                autocomplete="phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label class="focus-label">{{ __('Mobile Number') }}</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input id="email" type="email"
                                                class="form-control floating @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required
                                                autocomplete="email">
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
                                        <div class="form-group form-focus">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                            <label class="focus-label">{{ __('Confirm Password') }}</label>
                                        </div>
                                        <div class="text-right">
                                            @if (isset($url) && $url === 'doctor')
                                            <a class="forgot-link" href={{url('/login/doctor')}}>Already have an account?</a>
                                            @else
                                            <a class="forgot-link" href={{url('/login')}}>Already have an account?</a>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">
                                            {{ __('Register') }}</button>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <span class="span-or">or</span>
                                        </div>
                                        <div class="row form-row social-login">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-facebook btn-block"><i
                                                        class="fab fa-facebook-f mr-1"></i> Login</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#" class="btn btn-google btn-block"><i
                                                        class="fab fa-google mr-1"></i> Login</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Account Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
