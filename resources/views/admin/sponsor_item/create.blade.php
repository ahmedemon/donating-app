@extends('layouts.admin.app', ['pageTitle'=>'Add Sponsor'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">   
                        <h4 class="card-title">{{ $headerTitle }}</h4>
                        <a href="{{ route('admin.sponsor-item.index') }}" class="btn btn-sm btn-secondary">Go Back</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        <div class="basic-form">
                            <form action="{{ route('admin.sponsor-item.store') }}" method="POST" class="form-valide-with-icon needs-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="created_by">
                                <div class="mb-3 row">
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validateTitle">Title</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="title" class="form-control" id="validateTitle" value="{{ old('title') }}" placeholder="Enter title here.." required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validatePrice">Price</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="number" name="price" class="form-control" id="validatePrice" value="{{ old('price') }}" placeholder="Enter price here.." required>
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validateRewardPoint">Reward Point</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="number" name="reward_point" class="form-control" id="validateRewardPoint" value="{{ old('reward_point') }}" placeholder="Enter reward point here.." required>
                                            @error('reward_point')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="validateShippingAddress">Shipping Address</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <input type="text" name="shipping_address" class="form-control" id="validateShippingAddress" value="{{ old('shipping_address') }}" placeholder="Enter shipping address here.." required>
                                            @error('shipping_address')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Sponsored By</label> <span class="text-danger">*</span>
                                        <select id="inputState" class="default-select form-control wide" name="sponsored_by" required>
                                            <option value="">-- Select Sponsor --</option>
                                            @foreach ($sponsors as $sponsor)
                                                <option value="{{ $sponsor->id }}">{{ $sponsor->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sponsored_by')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="descriptionEditor">Company Description</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                                            <textarea name="description" id="descriptionEditor" class="form-control" placeholder="Enter description here.." required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="text-label form-label" for="Image">Product Image</label> <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <input type="file" name="image" id="Image" class="border" required>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="w-50 btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection