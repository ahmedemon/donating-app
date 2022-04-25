@extends('layouts.admin.app')
@push('croppercss')
    <link rel="stylesheet" href="{{ asset('backend/css/donation-cropper.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
@endpush
@section('content')
    <div class="body">
        <div class="container-fluid">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header d-block text-center">
                        <h4 class="card-title">Edit Donated Product</h4>
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
                            <form action="{{ route('admin.donation.requests.update', $donation->id) }}" method="POST" class="form-valide-with-icon needs-validation" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $donation->user_id }}">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="container d-flex justify-content-center mt-0 px-0">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="donation-image" name="images" accept=".png, .jpg, .jpeg" class="donation-image">
                                                        <input type="hidden" name="cropimage64" id="cropimage64">
                                                        <label for="donation-image"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="donationImagePreview" style="background-image: url('{{ $donation->images ? asset('storage/donation/' . $donation->images) : asset('frontend/img/avatar.svg') }}')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="text-label form-label" for="validationCustomTitle">Title</label> <span class="small text-danger">*</span>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                <input type="text" name="title" value="{{ old('title', $donation->title) ?? session('last_created_user.title') }}" class="form-control @error('title') is-invalid @enderror" id="validationCustomTitle" placeholder="Enter Product Title.." required>
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-label form-label" for="validationPrice">Price</label> <span class="small text-danger">*</span>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                                <input type="number" name="price" value="{{ old('price', $donation->price) ?? session('last_created_user.price') }}" class="form-control" id="validationPrice" placeholder="Enter Product Price.." required>
                                                @error('price')
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
                                        <div class="col-md-6">
                                            <label class="text-label form-label" for="validationPoint">Point</label> <span class="small text-danger">*</span>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-pencil-alt"></i> </span>
                                                <input type="number" name="point" value="{{ old('point', $donation->point) ?? session('last_created_user.point') }}" class="form-control" id="validationPoint" placeholder="Enter Product point.." required readonly>
                                                @error('point')
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
                                                    @foreach ($categories as $category)
                                                        <option {{ $donation->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                    @foreach ($durations as $duration)
                                                        <option value="{{ $duration->id }}">{{ $duration->duration . ' ' . $duration->type }}</option>
                                                    @endforeach
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
                                                <input type="text" name="shipping_address" value="{{ old('shipping_address', $donation->shipping_address) ?? session('last_created_user.shipping_address') }}" class="form-control" id="shippingAddress" placeholder="Enter Product shipping address.." required>
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
                                                <textarea name="description" style="height: 100px;" class="form-control" id="description" placeholder="Enter customer present address...">{{ old('description', $donation->description) ?? session('last_created_user.description') }}</textarea>
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
        <div class="modal fade bd-example-modal-lg imagecrop" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-11">
                                    <img id="image" src="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('cropperjs')
    {{-- <script id="rendered-js">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#donationImagePreview').css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#donation-image").change(function() {
            readURL(this);
        });
        //# sourceURL=pen.js
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <script>
        var $modal = $('.imagecrop');
        var image = document.getElementById('image');
        var cropper;
        $(".body").on("change", ".donation-image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 0.86 / 1,
                viewMode: 0.86 / 1,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $(".body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 292,
                height: 338,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#cropimage64').val(base64data);
                    document.getElementById('donationImagePreview').style.backgroundImage = "url(" + base64data + ")";
                    $modal.modal('hide');
                }
            });
        })
    </script>

    {{-- point from price / 3 --}}
    <script>
        var userInput = document.getElementById('validationPrice');
        userInput.addEventListener('keyup', function(e) {
            if (isNumeric(this.value) == true) {
                var divide = Math.round(this.value / 3);
                $("#validationPoint").val(divide);
            } else {
                $("#validationPoint").val('');
            }
        })

        function isNumeric(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }
    </script>
@endpush
