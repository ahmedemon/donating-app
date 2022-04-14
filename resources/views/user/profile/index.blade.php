@extends('layouts.user.app')
@push('croppercss')
    <style>
        .container {
            max-width: 960px;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin: 20px 0 20px;
        }

        h1 small {
            display: block;
            font-size: 15px;
            padding-top: 8px;
            color: gray;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        #image {
            display: block;
            max-width: 100%;
            height: 60vh;
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
@endpush
@section('content')
    <div class="body">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="float-right btn btn-sm btn-outline-info" href="{{ route('profile.edit', Auth::user()->id) }}">Edit</a>
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center align-items-center px-0 mb-3">
                                    {{-- {{ Auth::user()->image }} --}}
                                    {{-- ------------------------- --}}
                                    <form action="{{ route('profile.image', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="container">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" class="imageUpload">
                                                    <input type="hidden" name="base64image" id="base64image">
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{ Auth::user()->image ? asset('storage/user/' . Auth::user()->image) : asset('frontend/img/avatar.svg') }}')">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    {{-- <strong class="text-white">Upload</strong> --}}
                                                    <button type="submit" class="btn-xs btn btn-primary">
                                                        {{-- <i class="fas fa-arrow-circle-up"></i> --}}
                                                        Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- ------------------------- --}}
                                </div>
                                <div class="col-10 col-lg-8 d-flex align-items-center">
                                    <table class="w-100 table">
                                        <tr>
                                            <td colspan="2">
                                                <div class="d-flex justify-content-center">
                                                    <div class="d-flex">
                                                        <h2>{{ Auth::user()->name }}</h2>
                                                        <small class="small">
                                                            @if (Auth::user()->is_active == 1)
                                                                <i class="fas fa-circle text-success"></i>
                                                            @else
                                                                <i class="fas fa-circle text-warning"></i>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-user text-secondary"></i>
                                                            {{ Auth::user()->username }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-phone-square-alt text-success"></i>
                                                            0{{ Auth::user()->phone }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-envelope-open text-danger"></i>
                                                            {{ Auth::user()->email }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-map text-secondary"></i>
                                                            {{ Auth::user()->address }}
                                                        </p>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fa fa-star text-warning"></i>
                                                            Rank : {{ Auth::user()->position ?? 'Not Set' }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-check-circle text-warning"></i>
                                                            Joining Date : {{ date('Y-m-d', strtotime(Auth::user()->created_at)) }}
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="my-0">
                                                            <i class="fas fa-check-circle text-warning"></i>
                                                            @php
                                                                $joining_date = Carbon\Carbon::parse(Auth::user()->created_at);
                                                                // $now = Carbon\Carbon::now();
                                                            @endphp
                                                            Joined {{ $joining_date ? $joining_date->diffInDays() : '' }} days ago
                                                        </p>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="my-0">
                                                    <i class="fas fa-wallet text-info"></i>
                                                    Current Balance: {{ $wallet['current_balance'] }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="my-0">
                                                    <i class="fas fa-wallet text-info"></i>
                                                    Pucrhase Point : {{ $wallet['total_purchased_balance'] }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="my-0">
                                                    <i class="fas fa-wallet text-info"></i>
                                                    Total Sale Balance: {{ $wallet['total_sale_balance'] }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="my-0">
                                                    <i class="fas fa-wallet text-info"></i>
                                                    Total Sale : {{ $wallet['total_purchased'] }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Purchased: {{ $wallet['total_purchased'] }}
                                            </p>
                                        </td> --}}
                                            {{-- <td>
                                            <p class="my-0">
                                                <i class="fas fa-wallet text-info"></i>
                                                Total Sale : {{ $wallet['total_sale'] }}
                                            </p>
                                        </td> --}}
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
        Launch demo modal
    </button> --}}

        <!-- Modal -->
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
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
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
        $(".body").on("change", ".imageUpload", function(e) {
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
                aspectRatio: 1,
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $(".body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64image').val(base64data);
                    document.getElementById('imagePreview').style.backgroundImage = "url(" + base64data + ")";
                    $modal.modal('hide');
                }
            });
        })
    </script>
@endpush
