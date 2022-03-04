@extends('layouts.user.app', ['pageTitle'=>'Register'])
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
                <div class="col-md-8 mt-5 mt-lg-0">
                    <div class="card border" style="background-color: #090f289e !important;">
                        <div class="card-body">
                            <h2 class="text-white text-center py-2">Register</h2>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="row justify-content-center">
                                <div class="col-md-12 mb-3">
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 px-4">
                                                <label for="name"
                                                    class="col-form-label text-white small text-md-right">Name</label>
                                                <input id="name" type="text"
                                                    class="form-control bg-transparent text-white @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" required autocomplete="name"
                                                    autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="username"
                                                    class="col-form-label text-white small text-md-right">Username</label>
                                                <input id="username" type="text"
                                                    class="form-control bg-transparent text-white @error('username') is-invalid @enderror"
                                                    name="username" value="{{ old('username') }}" required
                                                    autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="phone"
                                                    class="col-form-label text-white small text-md-right">Phone</label>
                                                <input id="phone" type="number"
                                                    class="form-control bg-transparent text-white @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                                    autofocus>

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="email"
                                                    class="col-form-label text-white small text-md-right">E-Mail
                                                    Address</label>
                                                <input id="email" type="email"
                                                    class="form-control bg-transparent text-white @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="password"
                                                    class="col-form-label text-white small text-md-right">Password</label>
                                                <input id="password" type="password"
                                                    class="form-control bg-transparent text-white @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="password-confirm"
                                                    class="col-form-label text-white small text-md-right">Confirm
                                                    Password</label>
                                                <input id="password-confirm" type="password"
                                                    class="form-control bg-transparent text-white"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="address"
                                                    class="col-form-label text-white small text-md-right">address</label>
                                                <input id="address" type="text"
                                                    class="form-control bg-transparent text-white @error('address') is-invalid @enderror"
                                                    name="address" required autocomplete="new-address">

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4 text-white">
                                                <label
                                                    class="col-form-label text-white small text-md-right">Gender</label><br>

                                                <input id="male" type="radio"
                                                    class="form-check-input px-1 bg-transparent text-white" name="gender"
                                                    value="Male">
                                                <label for="male"
                                                    class="form-check-label text-white text-md-right">Male</label>&nbsp;

                                                <input id="female" type="radio"
                                                    class="form-check-input px-1 bg-transparent text-white" name="gender"
                                                    value="Female">
                                                <label for="female"
                                                    class="form-check-label text-white text-md-right">Female</label>&nbsp;

                                                <input id="others" type="radio"
                                                    class="form-check-input px-1 bg-transparent text-white" name="gender"
                                                    value="Others">
                                                <label for="others"
                                                    class="form-check-label text-white text-md-right">Others</label>&nbsp;

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="image"
                                                    class="col-form-label text-white small text-md-right">Profile
                                                    Picture</label>
                                                <input id="image" type="file"
                                                    class="bg-transparent text-white border w-100 @error('image') is-invalid @enderror"
                                                    name="image" value="{{ old('image') }}" required autocomplete="image"
                                                    autofocus>

                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center my-4">
                                            <button type="submit" class="btn w-50 btn-primary"> Register </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
