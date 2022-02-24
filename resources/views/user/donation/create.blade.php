@extends('layouts.user.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header d-block text-center">
                    <h4 class="card-title">Donate A Product</h4>
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
                        <form action="{{ route('donation.store') }}" method="POST" class="form-valide-with-icon needs-validation" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="validationCustomTitle">Title</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            <input type="text" name="title" value="{{ old('title') ?? session('last_created_user.title') }}" class="form-control @error('title') is-invalid @enderror" id="validationCustomTitle" placeholder="Enter Product Title.." required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="profilePicture">Product Image</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="far fa-images"></i> </span>
                                            <div class="form-file form-control">
                                                <input type="file" name="images" class="form-file-input form-control" id="images" accept="images">
                                            </div>
                                        </div>
                                        @error('images')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-label form-label" for="validationPoint">Point</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                            <input type="number" name="point" value="{{ old('point') ?? session('last_created_user.point') }}" class="form-control" id="validationPoint" placeholder="Enter Product point.." required>
                                            @error('point')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-label form-label" for="validationPrice">Price</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                            <input type="number" name="price" value="{{ old('price') ?? session('last_created_user.price') }}" class="form-control" id="validationPrice" placeholder="Enter Product Price.." required>
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="Categories">Select Category</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <select class="input-group-text form-control" style="text-align: left" name="category_id" required id="Categories">
                                                    <option selected>-- Select --</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="Used_duration">Used Duration</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <select class="input-group-text form-control" style="text-align: left" name="used_duration" required id="Used duration">
                                                <option value="6">6 Months</option>
                                            </select>
                                        </div>
                                        @error('used_duration')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-label form-label" for="shippingAddress">Shipping Address</label> <span class="small text-danger">*</span>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                            <input type="text" name="shipping_address" value="{{ old('shipping_address') ?? session('last_created_user.shipping_address') }}" class="form-control" id="shippingAddress" placeholder="Enter Product shipping address.." required>
                                            @error('shipping_address')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text-label form-label" for="description">Product Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i> </span>
                                            <textarea name="description" style="height: 100px;" class="form-control" id="description" placeholder="Enter customer present address...">{{ old('description') ?? session('last_created_user.description') }}</textarea>
                                        </div>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-block text-center mt-2">
                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection