@extends('layouts.admin.app', ['pageTitle'=>'Add Sponsor'])
@push('croppercss')
    <link rel="stylesheet" href="{{ asset('backend/css/donation-cropper.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
@endpush
@section('content')
    <div class="body">
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
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="container d-flex justify-content-center mt-0 px-0">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="sponsored-image" name="image" accept=".png, .jpg, .jpeg" class="sponsored-image">
                                                            <input type="hidden" name="cropimage64" id="cropimage64">
                                                            <label for="sponsored-image"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="sponsoredImagePreview" style="background-image: url('{{ asset('frontend/img/dummy-product.jpg') }}')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    $('#sponsoredImagePreview').css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#sponsored-image").change(function() {
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
        $(".body").on("change", ".sponsored-image", function(e) {
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
                    document.getElementById('sponsoredImagePreview').style.backgroundImage = "url(" + base64data + ")";
                    $modal.modal('hide');
                }
            });
        })
    </script>
@endpush
