@extends('layouts.user.app', ['pageTitle'=>'Login'])
    <link rel="stylesheet" href="{{ asset('frontend/css/background.animated.css') }}">
    <style>
        [data-theme-version="dark"] .form-control:focus {
            border-color: #f93a0b !important;
        }
        [data-theme-version="dark"] .form-control {
            border-color: #ffff !important;
        }
    </style>
@section('content')
<div class="particles">
    @include('layouts.animated_perticles')
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5 mt-lg-0">
                <div class="card border border-dark" style="background-color: #090f289e !important;">
                    <div class="card-body">
                        @if(Session::has('error'))
                            <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <h2 class="text-white text-center py-2">Login</h2>
                        <div class="row justify-content-center my-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="col-md-12 mb-3">
                                    <label for="email" class="col-form-label text-white small text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control bg-transparent text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="password" class="col-form-label text-white small text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control bg-transparent text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row d-flex justify-content-between mt-0 mb-0">
                                    <div class="mb-0">
                                        <div class="form-check custom-checkbox ms-1">
                                            <input type="checkbox" class="form-check-input" name="checkbox" id="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-white" for="form-checkbox">Remember my preference</label>
                                            @if (Route::has('password.request'))
                                                <div class="mb-1">
                                                    <a class="text-primary" href="{{ route('password.request') }}">Forgot Password?</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <button class="btn btn-primary btn-sm btn-block">Sign in</button>
                                </div>
                            </form>
                            <div class="new-account mt-1">
                                <p class="p-0 m-0 text-white">Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
