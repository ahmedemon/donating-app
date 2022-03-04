@extends('layouts.admin.app', ['pageTitle'=>'Register'])

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mt-5 mt-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-white text-center py-2">Update ({{ $user->name }})</h3>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="row justify-content-center">
                                <div class="col-md-12 mb-3">
                                    <form method="POST" action="{{ route('admin.user-request.update.request', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 px-4">
                                                <label for="name" class="col-form-label text-white small text-md-right">Name</label>
                                                <input id="name" type="text" class="form-control text-white @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="username" class="col-form-label text-white small text-md-right">Username</label>
                                                <input id="username" type="text" class="form-control text-white @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="phone" class="col-form-label text-white small text-md-right">Phone</label>
                                                <input id="phone" type="number" class="form-control text-white @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="phone" autofocus>

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="email" class="col-form-label text-white small text-md-right">E-Mail Address</label>
                                                <input id="email" type="email" class="form-control text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 px-4">
                                                <label for="address" class="col-form-label text-white small text-md-right">Address</label>
                                                <input id="address" type="text" value="{{ old('address', $user->address) }}" class="form-control text-white textarea @error('address') is-invalid @enderror" name="address" required autocomplete="new-address" placeholder="Enter Your Address">

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4 text-white">
                                                <label class="col-form-label text-white small text-md-right">Gender</label><br>

                                                <input id="male" type="radio" class="form-check-input px-1 text-white" name="gender" value="Male">
                                                <label for="male" class="form-check-label text-white text-md-right">Male</label>&nbsp;

                                                <input id="female" type="radio" class="form-check-input px-1 text-white" name="gender" value="Female">
                                                <label for="female" class="form-check-label text-white text-md-right">Female</label>&nbsp;

                                                <input id="others" type="radio" class="form-check-input px-1 text-white" name="gender" value="Others">
                                                <label for="others" class="form-check-label text-white text-md-right">Others</label>&nbsp;

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 px-4">
                                                <label for="image" class="col-form-label text-white small text-md-right">Profile Picture</label>
                                                <input id="image" type="file" class="text-white border w-100 @error('image') is-invalid @enderror" name="image" value="{{ old('image', $user->image) }}" required autocomplete="image" autofocus>

                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center my-4">
                                            <button type="submit" class="btn w-50 btn-primary">Update</button>
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
