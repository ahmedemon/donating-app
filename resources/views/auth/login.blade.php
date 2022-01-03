@extends('layouts.user.app', ['pageTitle'=>'Login'])
<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/background.animated.css') }}">
@section('content-without-menubar')
<div class="container position-fixed justify-content-center" style="max-width: 100% !important; background-image: linear-gradient(to right, #193f88 0%,#0e082c 99%);">
    @include('layouts.animated_perticles')
    <div class="row justify-content-center login-panel">
        <div class="col-md-4">
            <div class="card border-0" style="background-color: #090f289e !important;">
                <div class="card-body">
                    <h2 class="text-white text-center py-2">Login</h2>
                    <div class="row justify-content-center position-relative">
                        <div class="col-md-10">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-form-label text-white small text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control bg-transparent text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-form-label text-white small text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control bg-transparent text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="signUp-condition signIn-condition">
                                    <div class="checkbox-theme-default custom-checkbox ">
                                        <input class="checkbox" name="remember" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">
                                            <span class="checkbox-text">Keep me logged in</span>
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="javascript:void();" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <button class="btn btn-primary btn-sm btn-block">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
