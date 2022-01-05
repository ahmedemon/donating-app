@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Change password</h4>
                    </div>
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
                            <form action="{{ route('admin.update.password') }}" method="POST" class="form-valide-with-icon needs-validation">
                                @csrf @method('PUT')

                                <div class="mb-3">
                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <label class="text-label form-label" for="old_password">Your Old
                                                Password </label> <span class="small text-danger">*</span>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter your old password.." required>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-label form-label" for="dlab-password">Password </label> <span class="small text-danger">*</span>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" name="password" class="form-control @error('password') is_invalid @enderror" id="dlab-password" placeholder="Choose a safe one.." required>
                                                <span class="input-group-text show-pass">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-label form-label" for="dlab-password-confirmation">Re-type
                                                Password </label> <span class="small text-danger">*</span>
                                            <div class="input-group transparent-append">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                <input type="password" name="password_confirmation" class="form-control" id="dlab-password-confirmation" placeholder="Re-type password.." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn me-2 btn-primary btn-block">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection