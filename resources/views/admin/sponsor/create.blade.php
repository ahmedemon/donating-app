@extends('layouts.admin.app', ['pageTitle'=>'Add Sponsor'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">   
                        <h4 class="card-title">{{ $headerTitle }}</h4>
                        <a href="javascript:void();" class="btn btn-sm btn-secondary">Go Back</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        <div class="basic-form">
                            <form action="{{ route('admin.sponsor.store') }}" method="POST" class="form-valide-with-icon needs-validation">
                                @csrf
                                <input type="hidden" name="created_by">
                                <div class="mb-3 row">
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validateCompanyName">Company Name</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="company_name" class="form-control" id="validateCompanycompany_Name" value="{{ old('company_name') }}" placeholder="Enter company name here.." required>
                                            @error('company_name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validatePhone">Company Phone</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="number" name="phone" class="form-control" id="validatePhone" value="{{ old('phone') }}" placeholder="Enter phone here.." required>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validateAddress">Company Address</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="address" class="form-control" id="validateAddress" value="{{ old('address') }}" placeholder="Enter address here.." required>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="descriptionEditor">Company Description</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <textarea name="description" id="descriptionEditor" class="form-control" placeholder="Enter notice description.." required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection