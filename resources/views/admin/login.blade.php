@extends('layouts.user.app', ['pageTitle'=>'Admin Login'])
<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/background.animated.css') }}">
@section('content-without-menubar')
<div class="container position-fixed justify-content-center" style="max-width: 100% !important; background-image: linear-gradient(to right, #193f88 0%,#0e082c 99%);">
    @include('layouts.animated_perticles')
    <div class="row justify-content-center login-panel">
        <div class="col-md-4">
            <div class="card border-0" style="background-color: #090f289e !important;">
                <div class="card-body">
                    <h2 class="text-white text-center py-2">Admin Login</h2>
                    <div class="row justify-content-center position-relative">
                        <div class="col-md-10">
                            <div class="text-center mb-3">
                                <a href="{{ route('home') }}"><img class="rounded-lg" src="{{ asset('backend/img/logo.png') }}" alt="" height="120"></a>
                                {{-- <h4 class="text-center text-white">Welcome to Donate For Re-Use</h4> --}}
                            </div>
                            <form action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="mb-1" style="font-size: 18px;"><strong>Email</strong></label>
                                    <input type="email" class="form-control bg-transparent text-white @error('email') is-invalid @enderror" placeholder="hello@example.com" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" style="font-size: 18px;"><strong>Password</strong></label>
                                    <input type="password" class="form-control bg-transparent text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                </div>
                                <div class="row d-flex justify-content-between mt-4 mb-2">
                                    <div class="mb-3">
                                        <div class="form-check custom-checkbox ms-1">
                                        </div>
                                    </div>
                                    @if (Route::has('admin.password.request'))
                                        <div class="mb-3">
                                            <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
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
