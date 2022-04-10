@extends('layouts.user.app')
@section('content')
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
                                @if (Auth::user()->image == !null)
                                    <img class="border rounded-circle" src="{{ asset('storage/user/' . Auth::user()->image) }}" alt="" height="150" width="150">
                                @else
                                    <img src="{{ asset('frontend/img/avatar.svg') }}" alt="" class="" height="150" width="150">
                                @endif
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <form action="{{ route('profile.image', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input class="border image" type="file" name="image">
                                        <button type="submit" class="btn-sm btn btn-xs sharp btn-primary">
                                            <i class="fas fa-arrow-circle-up"></i>
                                        </button>
                                    </div>
                                </form>
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

    {{-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div> --}}



    {{-- <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e) {
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
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
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
                    console.log();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('profile.image', Auth::user()->id) }}",
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            'image': base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            alert("Profile picture updated successfully!");
                        },
                        error: function(data) {
                            $modal.modal('hide');
                            alert("Something Wrong!");
                        }
                    });
                }
            });
        })
    </script> --}}
@endsection
