@extends('layouts.user.app', ['pageTitle'=> 'Request For Add Money'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="basic-form">
                        <form action="{{ route('profile.update', $user->id) }}" method="POST" class="form-valide-with-icon needs-validation">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="validationCustomerName">Name</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="validationCustomerName" placeholder="Enter a name.." required>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="validationusername">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="text" class="form-control disabled" disabled readonly placeholder="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="validationphone">Phone</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-mobile-alt"></i> </span>
                                            <input type="text" name="phone" value="0{{ old('phone', $user->phone) }}" class="form-control" id="validationphone" placeholder="Enter customer phone number.." required>
                                        </div>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="validationCustomEmail">Email</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="validationCustomEmail"
                                                placeholder="Enter customer valid e-mail address.." required>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="text-label form-label" for="address">Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i> </span>
                                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control" id="address"
                                            placeholder="Enter customer address...">
                                        </div>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn me-2 btn-primary">Submit</button>
                            <button type="reset" class="btn btn-dark">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
